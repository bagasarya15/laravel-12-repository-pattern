<?php

namespace App\Repositories\Auth;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Auth\RoleInterface;
use App\Http\Resources\Auth\RoleResource;
use App\Http\Requests\Auth\Role\StoreRequest;
use App\Http\Requests\Auth\Role\UpdateRequest;

class RoleRepository implements RoleInterface
{
  use ResponseTrait;

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
      $data = Role::create($validatedData);

      $resource = (new RoleResource($data))
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
      $data = Role::findOrFail($id);

      $data->update($validatedData);

      $resource = (new RoleResource($data))
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
      $data = Role::findOrFail($id);

      $data->delete();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('DELETED'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
