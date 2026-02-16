<?php

namespace App\Domain\Administration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord admin.
     */
    public function index(): View
    {
        return view('admin.index');
    }
}
