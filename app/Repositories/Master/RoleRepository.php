<?php

namespace App\Repositories\Master;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Master\RoleInterface;
use App\Traits\Swagger\Master\RoleSwagger;
use App\Http\Resources\Master\RoleResource;
use App\Http\Requests\Master\Role\StoreRequest;
use App\Http\Requests\Master\Role\UpdateRequest;

class RoleRepository implements RoleInterface
{
  use ResponseTrait, RoleSwagger;

  public function index(Request $request)
  {
    try {
      $keyword = $request->query("search");
      $isNotPaginate = $request->query("isNotPaginate");

      $collection = Role::latest();

      if ($keyword) {
        $collection->where('name', 'ILIKE', "%$keyword%");
      }

      $collection = $isNotPaginate ? $collection->get() : $collection->paginate($request->recordsPerPage)->appends(request()->query());

      $result = RoleResource::collection($collection)
        ->response()
        ->getData(true);

      return $this->wrapResponse($this->httpCode('OK'), $this->message('SUCCESS'), $result);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function store(StoreRequest $request)
  {
    try {
      DB::beginTransaction();

      $validatedData = $request->validated();
      $role = Role::create($validatedData);

      $resource = (new RoleResource($role))
        ->response()
        ->getData(true);

      DB::commit();

      return $this->wrapResponse($this->httpCode('CREATED'), $this->message('CREATED'), $resource);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function update(UpdateRequest $request, $id)
  {
    try {
      DB::beginTransaction();

      $validatedData = $request->validated();
      $role = Role::findOrFail($id);

      $role->update($validatedData);

      $resource = (new RoleResource($role))
        ->response()
        ->getData(true);

      DB::commit();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('UPDATED'), $resource);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function destroy($id)
  {
    try {
      $role = Role::findOrFail($id);

      $role->delete();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('DELETED'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
