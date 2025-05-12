<?php

namespace Database\Seeders;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $roles = Role::where('slug', 'super-admin')->first();

    $users = [
      [
        'username' => '2025001',
        'email' => 'admin@example.com',
        'password' => 'password',
      ],
      [
        'username' => '2025002',
        'email' => 'bagasarya@gmail.com',
        'password' => 'password',
      ],

    ];

    foreach ($users as $data) {
      $user = User::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      DB::table('auth.users_has_roles')->insert([
        'id' => Str::uuid(),
        'user_id' => $user->id,
        'role_id' => $roles->id ?? null,
        'assigned_at' => now(),
      ]);
    }
  }
}
