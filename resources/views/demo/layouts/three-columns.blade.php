@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="container-xl mb-4">
        <a href="{{ route('demo.layouts.index') }}" class="btn btn-ghost-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Back to Layouts
        </a>
    </div>

    <div class="container-xl">
        <div class="page-header mb-4">
            <h1 class="page-title">Three Columns Layout</h1>
            <p class="text-secondary mt-2">Left sidebar + Main content + Right sidebar (mobile: all stacked)</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar - mobile: full width, desktop: 20% -->
            <div class="col-12 col-xl-2 mb-3 mb-xl-0 order-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                            Home
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            Profile
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                            Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content - mobile: full width, desktop: 60% -->
            <div class="col-12 col-xl-7 mb-3 mb-xl-0 order-3 order-xl-2">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Main Content</h3>
                    </div>
                    <div class="card-body">
                        <p>Central content area. On mobile, all three columns stack vertically. On large screens (xl+), they sit side-by-side.</p>
                        <p class="text-secondary">Layout: <code>col-xl-2</code> (left) + <code>col-xl-7</code> (center) + <code>col-xl-3</code> (right) = 12 columns</p>
                    </div>
                </div>

                <div class="row row-cards">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-blue text-white me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h4l3 8l4 -16l3 8h4" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="m-0">2,456</h3>
                                        <div class="text-secondary">Active Users</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-blue" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-green text-white me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="m-0">$48,256</h3>
                                        <div class="text-secondary">Revenue</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Activity Feed</h3>
                    </div>
                    <div class="card-table table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Alice Johnson</td>
                                    <td class="text-secondary">Created new project</td>
                                    <td><span class="badge bg-success">New</span></td>
                                </tr>
                                <tr>
                                    <td>Bob Smith</td>
                                    <td class="text-secondary">Updated documentation</td>
                                    <td><span class="badge bg-info">Updated</span></td>
                                </tr>
                                <tr>
                                    <td>Carol White</td>
                                    <td class="text-secondary">Fixed bug #1234</td>
                                    <td><span class="badge bg-warning">Fixed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar - mobile: full width, desktop: 25% -->
            <div class="col-12 col-xl-3 order-2 order-xl-3 mb-3 mb-xl-0">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Notifications</h3>
                    </div>
                    <div class="card-body">
                        <div class="divide-y">
                            <div class="py-2">
                                <div class="text-truncate">
                                    <strong>New message</strong> from Sarah
                                </div>
                                <div class="text-secondary small">5 min ago</div>
                            </div>
                            <div class="py-2">
                                <div class="text-truncate">
                                    <strong>Task completed:</strong> Design review
                                </div>
                                <div class="text-secondary small">1 hour ago</div>
                            </div>
                            <div class="py-2">
                                <div class="text-truncate">
                                    <strong>Update available</strong>
                                </div>
                                <div class="text-secondary small">2 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Tags</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge bg-blue-lt">Laravel</span>
                            <span class="badge bg-green-lt">PHP</span>
                            <span class="badge bg-red-lt">Bootstrap</span>
                            <span class="badge bg-yellow-lt">JavaScript</span>
                            <span class="badge bg-purple-lt">Alpine.js</span>
                            <span class="badge bg-cyan-lt">Tabler</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Calendar</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="h1 mb-1">29</div>
                            <div class="text-secondary">December 2025</div>
                        </div>
                        <hr>
                        <div class="small">
                            <div class="mb-2">
                                <span class="badge bg-primary me-2">•</span>
                                Team meeting at 10:00
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-success me-2">•</span>
                                Code review at 14:00
                            </div>
                            <div>
                                <span class="badge bg-warning me-2">•</span>
                                Deploy to production
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
