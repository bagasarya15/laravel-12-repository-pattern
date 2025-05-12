<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Auth\UserInterface;
use App\Http\Requests\Auth\User\StoreRequest;
use App\Http\Requests\Auth\User\UpdateRequest;

class UserController extends Controller
{
  protected $interface;

  public function __construct(UserInterface $interface)
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
