<?php

namespace App\Interfaces\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\User\StoreRequest;
use App\Http\Requests\Auth\User\UpdateRequest;

interface UserInterface
{
  public function index(Request $request);

  public function store(StoreRequest $request);

  public function update(UpdateRequest $request, $id);

  public function destroy($id);
}
