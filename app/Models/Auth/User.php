<?php

namespace App\Models\Auth;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Master\Petugas;
use App\Models\Master\Pengunjung;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

  protected $guarded = [];
  protected $table = 'auth.users';

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class, 'auth.users_has_roles', 'user_id', 'role_id');
  }

  public function pengunjung(): BelongsTo
  {
    return $this->belongsTo(Pengunjung::class, 'id', 'user_id');
  }

  public function petugas(): BelongsTo
  {
    return $this->belongsTo(Petugas::class, 'id', 'user_id');
  }
}
