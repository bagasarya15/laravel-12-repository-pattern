<?php

namespace App\Interfaces\Master;

use Illuminate\Http\Request;
use App\Http\Requests\Master\Pengunjung\StoreRequest;
use App\Http\Requests\Master\Pengunjung\UpdateRequest;

interface PengunjungInterface
{
  public function index(Request $request);

  public function store(StoreRequest $request);

  public function update(UpdateRequest $request, $id);

  public function destroy($id);
}
