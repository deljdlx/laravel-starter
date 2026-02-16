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
        <h1 class="page-title">List + Detail Layout</h1>
        <p class="text-secondary mt-2">Master-detail pattern (mobile: separate views, desktop: side-by-side)</p>
    </div>

    <div class="row">
        <!-- List Panel - mobile: full width, desktop: 40% -->
        <div class="col-12 col-lg-5 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Messages</h3>
                    <div class="card-actions">
                        <a href="#" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            New
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex">
                                <div class="avatar bg-primary text-white me-3">JS</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">John Smith</div>
                                        <div class="text-secondary small">2 min</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        Hey, are you available for a quick call?
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="avatar bg-success text-white me-3">AJ</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">Alice Johnson</div>
                                        <div class="text-secondary small">15 min</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        The project files have been updated
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="avatar bg-warning text-white me-3">RW</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">Robert Wilson</div>
                                        <div class="text-secondary small">1 hour</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        Can you review the latest changes?
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="avatar bg-info text-white me-3">EB</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">Emily Brown</div>
                                        <div class="text-secondary small">2 hours</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        Meeting rescheduled to tomorrow
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="avatar bg-purple text-white me-3">MD</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">Mike Davis</div>
                                        <div class="text-secondary small">Yesterday</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        Great work on the presentation!
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="avatar bg-cyan text-white me-3">SM</div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="font-weight-medium">Sarah Miller</div>
                                        <div class="text-secondary small">Yesterday</div>
                                    </div>
                                    <div class="text-secondary small text-truncate">
                                        Don't forget about the deadline
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Panel - mobile: full width (typically on separate page), desktop: 60% -->
        <div class="col-12 col-lg-7">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-primary text-white me-3">JS</div>
                        <div class="flex-fill">
                            <div class="font-weight-medium">John Smith</div>
                            <div class="text-secondary small">john.smith@example.com</div>
                        </div>
                        <div class="ms-auto">
                            <button class="btn btn-ghost-secondary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </button>
                            <button class="btn btn-ghost-secondary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-secondary small mb-1">Today at 2:34 PM</div>
                        <h3 class="mb-3">Quick Call Request</h3>
                        <p>Hi there,</p>
                        <p>I hope this message finds you well. I wanted to reach out to see if you're available for a quick call this afternoon. We need to discuss the upcoming project milestones and align on the deliverables.</p>
                        <p>Would 3 PM work for you? Let me know if you need to reschedule.</p>
                        <p>Best regards,<br>John</p>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h4 class="mb-3">Attachments</h4>
                        <div class="row row-cards">
                            <div class="col-12 col-sm-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-blue-lt me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">project-plan.pdf</div>
                                                <div class="text-secondary small">2.4 MB</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-green-lt me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">timeline.xlsx</div>
                                                <div class="text-secondary small">856 KB</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <textarea class="form-control" rows="3" placeholder="Type your reply..."></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button class="btn btn-ghost-secondary btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
                                    </button>
                                    <button class="btn btn-ghost-secondary btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                    </button>
                                </div>
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
