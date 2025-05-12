<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  public function up(): void
  {
    DB::statement('DROP SCHEMA IF EXISTS auth CASCADE');
    DB::statement('DROP SCHEMA IF EXISTS master CASCADE');
    DB::statement('DROP SCHEMA IF EXISTS log CASCADE');

    DB::statement('CREATE SCHEMA auth');
    DB::statement('CREATE SCHEMA master');
    DB::statement('CREATE SCHEMA log');
  }

  public function down(): void
  {
    DB::statement('DROP SCHEMA IF EXISTS auth CASCADE');
    DB::statement('DROP SCHEMA IF EXISTS master CASCADE');
    DB::statement('DROP SCHEMA IF EXISTS log CASCADE');
  }
};
