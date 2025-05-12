<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MsRegionPostalCode;

class RegionPostalCodeSeeder extends Seeder
{
  public function run(): void
  {
    $csvFile = fopen(base_path("database/data/region_postal_code.csv"), 'r');
    try {
      DB::beginTransaction();

      $firstline = true;
      $countSuccess = 1;
      $countFail = 0;

      $index = 1;

      // Lewati 1 baris pertama
      for ($i = 0; $i < 1; $i++) {
        fgetcsv($csvFile, 2000, ",");
      }

      while (($data = fgetcsv($csvFile, 2000, ",")) !== false) {
        if ($firstline) {
          $firstline = false;
          continue;
        }

        $model = MsRegionPostalCode::find($data['0']);

        if ($model) {
          dump($data['5']);
          $countSuccess++;
          continue;
        }

        DB::table('master.region_postal_code')->insert([
          "id" => $data['0'],
          "postal_name" => $data['5'],
          "postal_code" => $data['10'],
          "subdistrict_id" => $data['3'],
          "created_at" => now(),
          "updated_at" => now()
        ]);

        $index++;
        $countSuccess++;
        echo "Data berhasil dibuat untuk: {$data['5']} (Total berhasil: {$countSuccess})\n";

        if ($countSuccess % 50 == 0) {
          DB::commit();
          DB::beginTransaction();
          dump('commit berhasil :' . $countSuccess);
        }
        echo "(Kode pos berhasil: {$countSuccess})\n";
      }

      DB::commit();
    } catch (\Exception $exception) {
      DB::rollback();
      throw $exception;
    } finally {
      fclose($csvFile);
      echo "\n--- Summary ---\n";
      echo "Total data berhasil: {$countSuccess}\n";
      echo "Total data gagal: {$countFail}\n";
    }
  }
}
