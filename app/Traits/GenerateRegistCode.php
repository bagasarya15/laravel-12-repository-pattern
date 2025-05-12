<?php

namespace App\Traits;

use App\Models\Master\Petugas;
use App\Models\Master\Pengunjung;
use Illuminate\Support\Facades\Route;

trait GenerateRegistCode
{
  public function generateRegistCode($type)
  {
    // Ambil tanggal hari ini dalam format YYYYMMDD
    $date = now()->format('Ymd');

    if (strtolower($type) == 'petugas') {
      $lastPetugas = Petugas::latest()
        ->first();

      // Jika tidak ada petugas sebelumnya, mulai dari nomor 1
      $lastNumber = $lastPetugas ? (int) substr($lastPetugas->no_registrasi, -5) : 0;
      $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

      return 'PTG-' . $date . '-' . $newNumber;
    } elseif (strtolower($type) == 'pengunjung') {
      $lastPengunjung = Pengunjung::latest()
        ->first();

      // Jika tidak ada pengunjung sebelumnya, mulai dari nomor 1
      $lastNumber = $lastPengunjung ? (int) substr($lastPengunjung->no_registrasi, -5) : 0;
      $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

      return 'PNG-' . $date . '-' . $newNumber;
    }

    return null;
  }
}
