<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private function collectLaborDays($start, $end)
    {
        $period = CarbonPeriod::between($start, $end)->filter('isWeekday');
        $days = [];

        foreach ($period as $date) {
            $days[] = $date->format('d F Y');
        }

        return $days;
    }

    public function index()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $workdays = $this->collectLaborDays($start, $end);
        return view('welcome')->with('workdays', $workdays);
    }
}
