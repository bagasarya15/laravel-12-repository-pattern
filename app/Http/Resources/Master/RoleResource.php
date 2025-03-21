<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
  // protected static $repository;

  // public function __construct($resource)
  // {
  //   parent::__construct($resource);

  //   if (!self::$repository) {
  //     self::$repository = app(Repository::class);
  //   }
  // }

  public function toArray($request)
  {

    // $user = self::$repository->getUser($this->id);

    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'created_at' => $this->created_at
    ];
  }
}
