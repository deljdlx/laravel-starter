<?php

namespace App\Support\DevTools\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Support\DevTools\Services\SchemaMermaidGenerator;
use Illuminate\Contracts\View\View;

class SchemaMermaidController extends Controller
{
    /**
     * Display the database schema as Mermaid diagram
     */
    public function show(): View
    {
        $generator = new SchemaMermaidGenerator;
        $mermaidCode = $generator->generate();

        return view('dev.schema-mermaid.index', [
            'mermaidCode' => $mermaidCode,
        ]);
    }
}
