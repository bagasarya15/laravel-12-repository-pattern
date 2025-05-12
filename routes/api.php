<?php

use Illuminate\Support\Facades\File;

$apiPath = __DIR__ . '/api';

$phpFiles = File::allFiles($apiPath);

foreach ($phpFiles as $file) {
  require $file->getRealPath();
}
