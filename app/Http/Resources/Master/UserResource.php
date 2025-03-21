<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      'roles' => $this->whenLoaded('roles', fn() => RoleResource::collection($this->roles)),
      'created_at' => $this->created_at
    ];
  }
}
