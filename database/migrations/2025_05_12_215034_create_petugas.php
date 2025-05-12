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
    Schema::create('master.petugas', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->foreignUuid('user_id')->nullable()->constrained('auth.users')->onDelete('set null');
      $table->string('nama_lengkap')->nullable();
      $table->string('no_registrasi')->nullable();
      $table->text('alamat')->nullable();
      $table->date('tanggal_lahir')->nullable();
      $table->string('jenis_kelamin')->nullable();
      $table->text('image')->nullable();
      $table->timestamp('expired_date')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.petugas');
  }
};
