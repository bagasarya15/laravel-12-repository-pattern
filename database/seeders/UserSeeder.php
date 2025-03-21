<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $role = Role::where('slug', '=', 'super-admin')->first();

    $user = User::create([
      'username' => 'superadmin',
      'email' => 'bagasarya@gmail.com',
      'password' => Hash::make('password'),
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    DB::table('users_has_roles')->insert([
      [
        'id' => Str::uuid(),
        'user_id' => $user->id,
        'role_id' => $role->id,
        'created_at' => now(),
      ],
    ]);
  }
}
