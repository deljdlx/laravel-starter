<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Services\SchemaMermaidGenerator;
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
