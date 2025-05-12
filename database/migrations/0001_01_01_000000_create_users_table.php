<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('auth.users', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string('username')->nullable();
      $table->string('email')->nullable()->unique();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('auth.password_reset_tokens', function (Blueprint $table) {
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });

    Schema::create('auth.sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('auth.users');
    Schema::dropIfExists('auth.password_reset_tokens');
    Schema::dropIfExists('auth.sessions');
  }
};
