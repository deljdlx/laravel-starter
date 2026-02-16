@extends('layouts.app')

@section('content')
<div class="container-xl py-4">
    <div class="mb-4">
        <a href="{{ route('demo.components') }}" class="btn btn-ghost-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Back to Components
        </a>
    </div>

    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">Layout Demos</h1>
                <p class="text-secondary mt-2">Mobile-first responsive layout examples using Bootstrap grid system</p>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <!-- Single Column -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.single-column') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">Single Column</div>
                                <div class="text-secondary small mt-1">Full-width content layout</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Two Columns -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.two-columns') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">Two Columns</div>
                                <div class="text-secondary small mt-1">Sidebar + main content</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Three Columns -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.three-columns') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">Three Columns</div>
                                <div class="text-secondary small mt-1">Left sidebar + content + right sidebar</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Grid Layout -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.grid') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">Grid Layout</div>
                                <div class="text-secondary small mt-1">Responsive card grid</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Dashboard -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.dashboard') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">Dashboard</div>
                                <div class="text-secondary small mt-1">Mixed layout with metrics</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- List Detail -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card card-link">
                <a href="{{ route('demo.layouts.list-detail') }}" class="d-block">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">List + Detail</div>
                                <div class="text-secondary small mt-1">Master-detail pattern</div>
                            </div>
                            <div class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
