<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('auth.roles')->insert([
      [
        'id' => Str::uuid(),
        'name' => 'super admin',
        'slug' => 'super-admin',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'pengunjung',
        'slug' => 'pengunjung',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'petugas',
        'slug' => 'petugas',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'peserta',
        'slug' => 'peserta',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
