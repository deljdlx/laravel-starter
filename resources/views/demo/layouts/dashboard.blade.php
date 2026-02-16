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
        <h1 class="page-title">Dashboard Layout</h1>
        <p class="text-secondary mt-2">Mixed layout with metrics, charts, and tables</p>
    </div>

    <!-- Top Metrics Row -->
    <div class="row mb-3">
        <div class="col-6 col-sm-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Users</div>
                    </div>
                    <div class="h1 mb-0">2,456</div>
                    <div class="text-success small">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                        +12% vs last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Revenue</div>
                    </div>
                    <div class="h1 mb-0">$48,256</div>
                    <div class="text-success small">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                        +8% vs last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Active Sessions</div>
                    </div>
                    <div class="h1 mb-0">384</div>
                    <div class="text-danger small">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7l6 6l4 -4l8 8" /><path d="M21 10l0 7l-7 0" /></svg>
                        -3% vs last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Conversion Rate</div>
                    </div>
                    <div class="h1 mb-0">3.2%</div>
                    <div class="text-secondary small">
                        No change
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-3">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Revenue Overview</h3>
                </div>
                <div class="card-body">
                    <div class="ratio ratio-21x9 bg-light">
                        <div class="d-flex align-items-center justify-content-center text-secondary">
                            Chart Placeholder (ECharts/ApexCharts)
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Traffic Sources</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Organic Search</span>
                            <span class="font-weight-bold">42%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 42%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Direct</span>
                            <span class="font-weight-bold">28%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 28%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Social Media</span>
                            <span class="font-weight-bold">18%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 18%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span>Referral</span>
                            <span class="font-weight-bold">12%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 12%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table and Activity -->
    <div class="row">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-secondary">#1234</td>
                                <td>John Doe</td>
                                <td>$250.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-secondary">#1233</td>
                                <td>Jane Smith</td>
                                <td>$180.50</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td><a href="#" class="btn btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-secondary">#1232</td>
                                <td>Bob Johnson</td>
                                <td>$320.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-secondary">#1231</td>
                                <td>Alice Brown</td>
                                <td>$95.75</td>
                                <td><span class="badge bg-info">Processing</span></td>
                                <td><a href="#" class="btn btn-sm">View</a></td>
                            </tr>
                            <tr>
                                <td class="text-secondary">#1230</td>
                                <td>Charlie Wilson</td>
                                <td>$450.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" class="btn btn-sm">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        <div class="py-3">
                            <div class="d-flex">
                                <div class="avatar bg-primary text-white me-3">JD</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">New order placed</div>
                                    <div class="text-secondary small">John Doe • 2 min ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <div class="d-flex">
                                <div class="avatar bg-success text-white me-3">JS</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">Payment received</div>
                                    <div class="text-secondary small">Jane Smith • 15 min ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <div class="d-flex">
                                <div class="avatar bg-warning text-white me-3">BJ</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">New user registered</div>
                                    <div class="text-secondary small">Bob Johnson • 1 hour ago</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <div class="d-flex">
                                <div class="avatar bg-info text-white me-3">AB</div>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">Order shipped</div>
                                    <div class="text-secondary small">Alice Brown • 2 hours ago</div>
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
