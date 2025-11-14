<div class="mb-3" {{ $attributes }}>
    @if($label !== null)
        <label class="form-label{{ $required ? ' required' : '' }}" for="{{ $id }}">
            {{ $label }}
            @if($description)
                <span class="form-label-description">{{ $description }}</span>
            @endif
        </label>
    @endif
    <input 
        type="{{ $type }}" 
        class="form-control" 
        name="{{ $name }}" 
        id="{{ $id }}"
        @if($placeholder !== null) placeholder="{{ $placeholder }}" @endif
        value="{{ old($name, $value) }}"
        @if($required) required aria-required="true" @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
    />
</div>
