@extends('layouts.app')

@section('title', 'Tabler UI Components')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Tabler UI Components</h1>
            <p class="text-muted">Various Tabler UI components demonstration</p>
        </div>
        <a href="{{ route('demo.components') }}" class="btn btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Back to Components
        </a>
    </div>
</div>

<div class="demo-section">
    <h2>Buttons</h2>
    <div class="demo-content">
        <button class="btn btn-primary">Primary Button</button>
        <button class="btn btn-secondary">Secondary Button</button>
        <button class="btn btn-success">Success Button</button>
        <button class="btn btn-danger">Danger Button</button>
        <button class="btn btn-warning">Warning Button</button>
        <button class="btn btn-info">Info Button</button>
    </div>
</div>

<div class="demo-section">
    <h2>Alerts</h2>
    <div class="demo-content">
        <div class="alert alert-primary" role="alert">
            A primary alert—check it out!
        </div>
        <div class="alert alert-success" role="alert">
            A success alert—check it out!
        </div>
        <div class="alert alert-danger" role="alert">
            A danger alert—check it out!
        </div>
        <div class="alert alert-warning" role="alert">
            A warning alert—check it out!
        </div>
    </div>
</div>

<div class="demo-section">
    <h2>Cards</h2>
    <div class="demo-content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Card title</h3>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Another card</h3>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-secondary">Learn more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Third card</h3>
                        <p class="card-text">Some more text to demonstrate the card component styling.</p>
                        <a href="#" class="btn btn-success">Action</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="demo-section">
    <h2>Badges</h2>
    <div class="demo-content">
        <span class="badge bg-primary">Primary</span>
        <span class="badge bg-secondary">Secondary</span>
        <span class="badge bg-success">Success</span>
        <span class="badge bg-danger">Danger</span>
        <span class="badge bg-warning">Warning</span>
        <span class="badge bg-info">Info</span>
    </div>
</div>

<div class="demo-section">
    <h2>Progress Bars</h2>
    <div class="demo-content">
        <div class="progress mb-3">
            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
        <div class="progress mb-3">
            <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>
        <div class="progress mb-3">
            <div class="progress-bar bg-info" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
        </div>
    </div>
</div>
