<?php

namespace App\Repositories\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Master\Petugas;
use App\Traits\GenerateRegistCode;
use Illuminate\Support\Facades\DB;
use App\Traits\HasBase64ImageUpload;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Master\PetugasInterface;
use App\Http\Resources\Master\PetugasResource;
use App\Http\Requests\Master\Petugas\StoreRequest;
use App\Http\Requests\Master\Petugas\UpdateRequest;

class PetugasRepository implements PetugasInterface
{
  use ResponseTrait, HasBase64ImageUpload, GenerateRegistCode;

  public function index(Request $request)
  {
    try {
      $keyword = $request->query("search");
      $isNotPaginate = $request->query("isNotPaginate");

      $collection = Petugas::latest();

      if ($keyword) {
        $collection->where('nama_lengkap', 'ILIKE', "%$keyword%");
      }

      $collection = $isNotPaginate ? $collection->get() : $collection->paginate($request->recordsPerPage)->appends(request()->query());

      $result = PetugasResource::collection($collection)
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

      $nomorRegistrasi = $this->generateRegistCode('petugas');
      $validatedData = $request->validated();
      $validatedData['no_registrasi'] = $nomorRegistrasi;

      if (!empty($validatedData['image']) && $this->isBase64Image($validatedData['image'])) {
        $path = $this->saveBase64Image($validatedData['image'], "images/image-petugas/$nomorRegistrasi");

        if ($path) {
          $validatedData['image'] = $path;
        }
      }

      $data = Petugas::create($validatedData);

      $resource = (new PetugasResource($data))
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

      $petugas = Petugas::where('id', $id)->firstOrFail();

      if (!empty($validatedData['image']) && $this->isBase64Image($validatedData['image'])) {
        $nomorRegistrasi = $petugas->no_registrasi;

        if ($petugas->image && Storage::disk('public')->exists($petugas->image)) {
          Storage::disk('public')->delete($petugas->image);
        }

        $path = $this->saveBase64Image($validatedData['image'], "images/image-petugas/$nomorRegistrasi");

        if ($path) {
          $validatedData['image'] = $path;
        }
      } else {
        unset($validatedData['image']);
      }

      $petugas->update($validatedData);

      $resource = (new PetugasResource($petugas))
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
      $data = Petugas::findOrFail($id);

      $data->delete();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('DELETED'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
