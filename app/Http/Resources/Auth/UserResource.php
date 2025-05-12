<?php

namespace App\Http\Resources\Auth;

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
      'user_profile' => $this->when(true, function () {
        $detail = $this->pengunjung ?? $this->petugas;
        $user_type = $this->pengunjung ? 'pengunjung' : 'petugas';

        return $detail ? [
          'id' => $detail->id,
          'nama_lengkap' => $detail->nama_lengkap,
          'no_registrasi' => $detail->no_registrasi,
          'image' => $detail->image,
          'expired_date' => $detail->expired_date,
          'user_type' => $user_type
        ] : null;
      }),
      'created_at' => $this->created_at,
    ];
  }
}
