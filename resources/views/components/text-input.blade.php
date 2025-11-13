<div class="mb-3" {{ $attributes }}>
    <label class="form-label{{ $required ? ' required' : '' }}" for="{{ $id }}">
        {{ $label }}
        @if($description)
            <span class="form-label-description">{{ $description }}</span>
        @endif
    </label>
    <input 
        type="{{ $type }}" 
        class="form-control" 
        name="{{ $name }}" 
        id="{{ $id }}"
        @if($placeholder !== null) placeholder="{{ $placeholder }}" @endif
        @if($value) value="{{ $value }}" @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
    />
</div>
