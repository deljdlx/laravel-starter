@php
// merge styles if any are passed to the component

@endphp

<div class="card" {{ $attributes->merge([
    'class' => '',
    'style' => '',
]) }}>

    @if(isset($title) && $title !== '')
        <div class="card-header">
            <h3 class="card-title h2">{{ $title }}</h3>
        </div>
    @endif

    {{-- check if slot with name body exists--}}
    @if (isset($body))
        <div {{ $body->attributes->merge([
            'class' => 'card-body',
            'style' => '',
        ]) }}>
            {{ $body }}
        </div>
    @else
        <div class="card-body">
            {{ $slot }}
        </div>
    @endif

</div>
