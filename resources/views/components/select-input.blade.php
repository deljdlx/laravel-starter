<div class="mb-3" {{ $attributes }}>
    @if($label !== null)
        <label class="form-label{{ $required ? ' required' : '' }}" for="{{ $id }}">
            {{ $label }}
            @if($description)
                <span class="form-label-description">{{ $description }}</span>
            @endif
        </label>
    @endif
    <select 
        class="form-select" 
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
        id="{{ $id }}"
        @if($required) required aria-required="true" @endif
        @if($disabled) disabled @endif
        @if($multiple) multiple @endif
    >
        @if($placeholder !== null && !$multiple)
            <option value="" disabled {{ !$isSelected('') && $selected === null && old($name) === null ? 'selected' : '' }} hidden>
                {{ $placeholder }}
            </option>
        @endif
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ $isSelected((string) $value) ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
