<?php

namespace App\Interfaces\Master;

use Illuminate\Http\Request;
use App\Http\Requests\Master\Petugas\StoreRequest;
use App\Http\Requests\Master\Petugas\UpdateRequest;

interface PetugasInterface
{
  public function index(Request $request);

  public function store(StoreRequest $request);

  public function update(UpdateRequest $request, $id);

  public function destroy($id);
}
