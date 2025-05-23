<?php

namespace App\Models\Auth;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
  use SoftDeletes, HasUuids;

  protected $guarded = [];
  protected $table = 'auth.roles';
  protected $keyType = 'string';
  public $incrementing = false;
  public $timestamps = true;

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'auth.users_has_roles', 'role_id', 'user_id');
  }

  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }
}
