<?php

namespace App\Support\Demo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ApexChartsController extends Controller
{
    public function index(): View
    {
        return view('demo.apexcharts');
    }
}
