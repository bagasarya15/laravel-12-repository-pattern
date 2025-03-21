<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users_has_roles', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
      $table->foreignUuid('role_id')->nullable()->constrained('roles')->onDelete('cascade');
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users_has_roles');
  }
};
