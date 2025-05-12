<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Master\PetugasInterface;
use App\Http\Requests\Master\Petugas\StoreRequest;
use App\Http\Requests\Master\Petugas\UpdateRequest;

class PetugasController extends Controller
{
  protected $interface;

  public function __construct(PetugasInterface $interface)
  {
    $this->interface = $interface;
  }

  public function index(Request $request)
  {
    return $this->interface->index($request);
  }

  public function store(StoreRequest $request)
  {
    return $this->interface->store($request);
  }

  public function update(UpdateRequest $request, $id)
  {
    return $this->interface->update($request, $id);
  }

  public function destroy($id)
  {
    return $this->interface->destroy($id);
  }
}
