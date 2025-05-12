<?php

namespace App\Repositories\Auth;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Master\Petugas;
use App\Models\Master\Pengunjung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Auth\UserInterface;
use App\Http\Resources\Auth\UserResource;
use App\Http\Requests\Auth\User\StoreRequest;
use App\Http\Requests\Auth\User\UpdateRequest;

class UserRepository implements UserInterface
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      $keyword = $request->query("search");
      $isNotPaginate = $request->query("isNotPaginate");

      $collection = User::with(['roles'])->latest();

      if ($keyword) {
        $collection->where('nomor_pokok', 'ILIKE', "%$keyword%");
      }

      $collection = $isNotPaginate ? $collection->get() : $collection->paginate($request->recordsPerPage)->appends(request()->query());

      $result = UserResource::collection($collection)
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
      $petugasId = $validatedData['petugas_id'] ?? null;
      $pengunjungId = $validatedData['pengunjung_id'] ?? null;

      unset($validatedData['role'], $validatedData['petugas_id'], $validatedData['pengunjung_id']);

      $user = User::create($validatedData);
      $role = null;

      if ($petugasId) {
        $role = Role::where('slug', 'petugas')->first();
        Petugas::where('id', $petugasId)->update([
          'user_id' => $user->id,
        ]);
      } elseif ($pengunjungId) {
        $role = Role::where('slug', 'pengunjung')->first();
        Pengunjung::where('id', $pengunjungId)->update([
          'user_id' => $user->id,
        ]);
      }

      if ($role && $role->id) {
        $user->roles()->attach($role->id, ['id' => (string) Str::uuid()]);
      }

      $resource = (new UserResource($user->load('roles')))
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

      $user = User::findOrFail($id);
      $validatedData = $request->validated();

      $user->update($validatedData);

      $resource = (new UserResource($user->load('roles')))
        ->response()
        ->getData(true);

      DB::commit();
      return $this->wrapResponse($this->httpCode('OK'), $this->message('SUCCESS'), $resource);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function destroy($id)
  {
    try {
      $data = User::findOrFail($id);

      $currentUserId = Auth::user()->id;

      if ($currentUserId == $data->id) {
        return $this->wrapResponse($this->httpCode('FORBIDDEN'), $this->message('CANNOT_DELETE_SELF'));
      }

      $data->delete();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('DELETED'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
