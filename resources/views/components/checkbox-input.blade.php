<label class="form-check{{ $inline ? ' form-check-inline' : '' }}" {{ $attributes }}>
    <input 
        type="checkbox" 
        class="form-check-input" 
        name="{{ $name }}" 
        id="{{ $id }}"
        @if($value !== null) value="{{ $value }}" @endif
        @if(old($name) !== null ? old($name) == $value : $checked) checked @endif
        @if($disabled) disabled @endif
    />
    @if($label !== null)
        <span class="form-check-label">{{ $label }}</span>
    @endif
    @if($description)
        <span class="form-check-description">{{ $description }}</span>
    @endif
</label>
