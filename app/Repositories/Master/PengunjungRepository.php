<?php

namespace App\Repositories\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Master\Pengunjung;
use App\Traits\GenerateRegistCode;
use Illuminate\Support\Facades\DB;
use App\Traits\HasBase64ImageUpload;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Master\PengunjungInterface;
use App\Http\Resources\Master\PengunjungResource;
use App\Http\Requests\Master\Pengunjung\StoreRequest;
use App\Http\Requests\Master\Pengunjung\UpdateRequest;

class PengunjungRepository implements PengunjungInterface
{
  use ResponseTrait, HasBase64ImageUpload, GenerateRegistCode;

  public function index(Request $request)
  {
    try {
      $keyword = $request->query("search");
      $isNotPaginate = $request->query("isNotPaginate");

      $collection = Pengunjung::latest();

      if ($keyword) {
        $collection->where('nama_lengkap', 'ILIKE', "%$keyword%");
      }

      $collection = $isNotPaginate ? $collection->get() : $collection->paginate($request->recordsPerPage)->appends(request()->query());

      $result = PengunjungResource::collection($collection)
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

      $nomorRegistrasi = $this->generateRegistCode('pengunjung');
      $validatedData = $request->validated();
      $validatedData['no_registrasi'] = $nomorRegistrasi;

      if (!empty($validatedData['image']) && $this->isBase64Image($validatedData['image'])) {
        $path = $this->saveBase64Image($validatedData['image'], "images/image-pengunjung/$nomorRegistrasi");

        if ($path) {
          $validatedData['image'] = $path;
        }
      }

      $data = Pengunjung::create($validatedData);

      $resource = (new PengunjungResource($data))
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

      $Pengunjung = Pengunjung::where('id', $id)->firstOrFail();

      if (!empty($validatedData['image']) && $this->isBase64Image($validatedData['image'])) {
        $nomorRegistrasi = $Pengunjung->no_registrasi;

        if ($Pengunjung->image && Storage::disk('public')->exists($Pengunjung->image)) {
          Storage::disk('public')->delete($Pengunjung->image);
        }

        $path = $this->saveBase64Image($validatedData['image'], "images/image-pengunjung/$nomorRegistrasi");

        if ($path) {
          $validatedData['image'] = $path;
        }
      } else {
        unset($validatedData['image']);
      }

      $Pengunjung->update($validatedData);

      $resource = (new PengunjungResource($Pengunjung))
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
      $data = Pengunjung::findOrFail($id);

      $data->delete();

      return $this->wrapResponse($this->httpCode('OK'), $this->message('DELETED'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
