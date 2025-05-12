<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait HasBase64ImageUpload
{
  /**
   * Simpan gambar base64 ke direktori.
   *
   * @param string $base64String
   * @param string $directory
   * @return string|null
   */
  public function saveBase64Image(string $base64String, string $directory): ?string
  {
    try {
      // Bersihkan whitespace
      $base64String = trim($base64String);

      // Deteksi mime dari signature base64
      $mimeType = $this->detectImageMimeType($base64String);

      if (!$mimeType) return null;

      $extension = match ($mimeType) {
        'image/jpeg' => 'jpeg',
        'image/jpg'  => 'jpg',
        'image/png'  => 'png',
        default      => null
      };

      if (!$extension) return null;

      // Decode base64
      $imageData = base64_decode($base64String);

      // Buat nama file unik
      $filename = Str::random(10) . '-' . now()->format('dmY') . '.' . $extension;

      // Simpan di storage/app/public/{directory}
      $path = "$directory/$filename";
      Storage::disk('public')->put($path, $imageData);

      return $path;
    } catch (\Throwable $th) {
      report($th);
      return null;
    }
  }

  /**
   * Deteksi MIME image dari header base64 (tanpa prefix)
   */
  private function detectImageMimeType(string $base64): ?string
  {
    $firstBytes = substr($base64, 0, 5);

    // JPEG
    if (strpos($firstBytes, '/9j/') === 0) {
      return 'image/jpeg';
    }

    // PNG
    if (strpos($base64, 'iVBOR') === 0) {
      return 'image/png';
    }

    // GIF (optional)
    if (strpos($base64, 'R0lGO') === 0) {
      return 'image/gif';
    }

    return null;
  }

  public function isBase64Image(string $data): bool
  {
    return preg_match('/^data:image\/\w+;base64,/', $data) || base64_decode($data, true) !== false;
  }
}
