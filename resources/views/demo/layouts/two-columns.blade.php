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
        <h1 class="page-title">Two Columns Layout</h1>
        <p class="text-secondary mt-2">Sidebar + Main content (mobile: stacked, tablet+: side-by-side)</p>
    </div>

    <div class="row">
        <!-- Sidebar - on mobile: full width, stacks first -->
        <div class="col-12 col-lg-3 mb-3 mb-lg-0 order-lg-1">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Navigation</h3>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">Profile</a>
                    <a href="#" class="list-group-item list-group-item-action">Settings</a>
                    <a href="#" class="list-group-item list-group-item-action">Reports</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Stats</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-secondary">CPU</span>
                            <span class="font-weight-bold">42%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 42%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-secondary">Memory</span>
                            <span class="font-weight-bold">68%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 68%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-secondary">Storage</span>
                            <span class="font-weight-bold">85%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - on mobile: full width, stacks second -->
        <div class="col-12 col-lg-9 order-lg-2">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Main Content Area</h3>
                </div>
                <div class="card-body">
                    <p>This is the main content area. On mobile devices, this appears below the sidebar. On larger screens (lg+), it appears side-by-side.</p>
                    <p class="text-secondary mb-0">The layout uses <code>col-12 col-lg-9</code> and <code>col-12 col-lg-3</code> for responsive behavior.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Card 1</h3>
                            <p class="text-secondary mb-0">Content cards stack on mobile, sit side-by-side on tablets</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Card 2</h3>
                            <p class="text-secondary mb-0">Using <code>col-sm-6</code> for tablet breakpoint</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        <div class="py-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary text-white me-3">JD</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">John Doe posted a comment</div>
                                    <div class="text-secondary small">2 minutes ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-success text-white me-3">AS</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">Alice Smith updated her profile</div>
                                    <div class="text-secondary small">15 minutes ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-warning text-white me-3">BJ</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">Bob Johnson created a new task</div>
                                    <div class="text-secondary small">1 hour ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
