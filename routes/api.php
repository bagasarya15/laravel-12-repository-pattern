<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$routes = glob(__DIR__ . "/api/*.php");
foreach ($routes as $route) require($route);
