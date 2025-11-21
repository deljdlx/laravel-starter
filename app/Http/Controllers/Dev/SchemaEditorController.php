<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;

class SchemaEditorController extends Controller
{
    /**
     * Display the schema editor page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dev.schema-editor.index');
    }
}
