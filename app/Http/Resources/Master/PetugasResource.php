<?php

namespace App\Http\Resources\Master;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetugasResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'nama_lengkap' => $this->nama_lengkap,
      'no_registrasi' => $this->no_registrasi,
      'alamat' => $this->alamat,
      'tanggal_lahir' => $this->tanggal_lahir,
      'jenis_kelamin' => $this->jenis_kelamin,
      'image' => $this->image,
      'expired_date' => $this->expired_date,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
