<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Admin\DashboardInterface;

class DashboardController extends Controller
{
  protected $interface;

  public function __construct(DashboardInterface $interface)
  {
    $this->interface = $interface;
  }

  public function dashboardData(Request $request)
  {
    return $this->interface->dashboardData($request);
  }

  public function getJamaahGrouped(Request $request)
  {
    return $this->interface->getJamaahGrouped($request);
  }

  public function trackingHistory(Request $request)
  {
    return $this->interface->trackingHistory($request);
  }
}
