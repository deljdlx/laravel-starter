<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ApexChartsController extends Controller
{
    public function index(): View
    {
        return view('demo.apexcharts');
    }
}
