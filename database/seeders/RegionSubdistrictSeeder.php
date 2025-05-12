<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MsRegionSubdistrict;

class RegionSubdistrictSeeder extends Seeder
{
  public function run(): void
  {
    $csvFile = fopen(base_path("database/data/region_subdistrict.csv"), 'r');
    try {
      DB::beginTransaction();

      $firstline = true;
      $countSuccess = 0;
      $countFail = 0;

      $index = 1;
      while (($data = fgetcsv($csvFile, 2000, ",")) !== false) {
        if ($firstline) {
          $firstline = false;
          continue;
        }

        $model = MsRegionSubdistrict::find($data['0']);

        if ($model) {
          continue;
        }

        DB::table('master.region_subdistrict')->insert([
          "id" => $data['0'],
          "subdistrict_name" => $data['4'],
          "subdistrict_code" => $data['3'],
          "city_id" => $data['2'],
          "created_at" => now(),
          "updated_at" => now()
        ]);

        $index++;
        $countSuccess++;
        echo "Data berhasil dibuat untuk: {$data['4']} (Total berhasil: {$countSuccess})\n";
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
