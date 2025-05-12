<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MsRegionProvince;

class RegionProvinceSeeder extends Seeder
{
  public function run(): void
  {
    $csvFile = fopen(base_path("database/data/region_province.csv"), 'r');
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

        $model = MsRegionProvince::find($data['0']);

        if ($model) {
          continue;
        }

        DB::table('master.region_province')->insert([
          "id" => $data['0'],
          "province_name" => $data['1'],
          "province_code" => $data['2'],
          "created_at" => now(),
          "updated_at" => now()
        ]);

        $index++;
        $countSuccess++;
        echo "Data berhasil dibuat untuk: {$data['1']} (Total berhasil: {$countSuccess})\n";
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
