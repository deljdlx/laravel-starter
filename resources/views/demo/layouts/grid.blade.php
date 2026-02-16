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
        <h1 class="page-title">Grid Layout</h1>
        <p class="text-secondary mt-2">Responsive card grid - mobile: 1 col, tablet: 2 cols, desktop: 3 cols, wide: 4 cols</p>
    </div>

    <div class="row row-cards">
        @for($i = 1; $i <= 12; $i++)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="ratio ratio-16x9 bg-light mb-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-secondary" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
                        </div>
                    </div>
                    <h3 class="card-title">Card {{ $i }}</h3>
                    <p class="text-secondary mb-3">
                        This is a card in a responsive grid. The layout adapts to screen size automatically.
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm bg-{{ ['blue', 'green', 'red', 'yellow', 'purple', 'cyan'][($i - 1) % 6] }}-lt">{{ chr(64 + $i) }}</div>
                        <div class="ms-2 flex-fill">
                            <div class="small font-weight-medium">Author {{ $i }}</div>
                            <div class="text-secondary small">2 hours ago</div>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-icon btn-ghost-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm">View</a>
                        <div class="text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                            {{ rand(10, 500) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Alternative: Masonry-style with different heights -->
    <div class="page-header mt-5 mb-4">
        <h2 class="page-title">Variable Height Cards</h2>
        <p class="text-secondary mt-2">Cards with different content lengths</p>
    </div>

    <div class="row row-cards">
        @php
        $heights = ['short', 'medium', 'tall', 'medium', 'short', 'tall', 'medium', 'short'];
        $texts = [
            'short' => 'Brief description.',
            'medium' => 'A medium-length description that provides more context about this card and its purpose.',
            'tall' => 'This is a longer description that contains multiple sentences. It demonstrates how cards with different content heights work in a responsive grid. The grid adapts beautifully across all screen sizes, ensuring readability and visual balance.'
        ];
        @endphp

        @foreach($heights as $index => $height)
        <div class="col-12 col-sm-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h3 class="card-title">{{ ucfirst($height) }} Card</h3>
                    <p class="text-secondary flex-fill">{{ $texts[$height] }}</p>
                    <div class="mt-auto pt-3">
                        <a href="#" class="btn btn-primary w-100">Action</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
