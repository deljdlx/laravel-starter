@extends('layouts.app')

@section('content')
<div class="container-xl py-4">
    <div class="mb-4">
        <a href="{{ route('demo.layouts.index') }}" class="btn btn-ghost-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Back to Layouts
        </a>
    </div>

    <div class="page-header mb-4">
        <h1 class="page-title">Single Column Layout</h1>
        <p class="text-secondary mt-2">Full-width content layout, mobile-first approach</p>
    </div>

    <!-- Full width article/content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Article Title</h3>
                </div>
                <div class="card-body">
                    <p class="text-secondary">
                        This is a single column layout. On mobile, it takes the full width. 
                        On larger screens, it's contained within the Bootstrap container for better readability.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Full width image card -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="ratio ratio-16x9 bg-light mb-3">
                        <div class="d-flex align-items-center justify-content-center text-secondary">
                            16:9 Image Placeholder
                        </div>
                    </div>
                    <h3>Full Width Media</h3>
                    <p class="text-secondary">Perfect for blog posts, articles, or image galleries</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Full width stats -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="h1 m-0">128</div>
                            <div class="text-secondary">Users</div>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="h1 m-0">854</div>
                            <div class="text-secondary">Posts</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="h1 m-0">2.4k</div>
                            <div class="text-secondary">Comments</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="h1 m-0">12k</div>
                            <div class="text-secondary">Views</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
