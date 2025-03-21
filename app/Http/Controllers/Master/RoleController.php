<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Master\RoleInterface;
use App\Http\Requests\Master\Role\StoreRequest;
use App\Http\Requests\Master\Role\UpdateRequest;

class RoleController extends Controller
{
  protected $interface;

  public function __construct(RoleInterface $interface)
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
