<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReteJsDemoController extends Controller
{
    /**
     * Display the Rete.js demo page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('retejs-demo');
    }
}
