<?php

namespace App\Interfaces\Master;

use Illuminate\Http\Request;
use App\Http\Requests\Master\Role\StoreRequest;
use App\Http\Requests\Master\Role\UpdateRequest;

interface RoleInterface
{
  public function index(Request $request);

  public function store(StoreRequest $request);

  public function update(UpdateRequest $request, $id);

  public function destroy($id);
}
