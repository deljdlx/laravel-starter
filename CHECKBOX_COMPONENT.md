# CheckboxInput Component Documentation

## Overview
The `CheckboxInput` component is a reusable Laravel Blade component designed to simplify form creation by providing a clean, consistent interface for checkbox input fields.

## Features
- Configurable label and name
- Optional value for multiple checkboxes with same name
- Support for checked and disabled states
- Inline layout support
- Optional description text
- Automatic ID generation based on name (can be overridden)
- Full support for additional HTML attributes via `$attributes`
- Integration with Laravel's `old()` helper for form repopulation

## Basic Usage

### Simple Checkbox
```blade
<x-checkbox-input 
    name="accept_terms" 
    label="I accept the terms and conditions" 
/>
```

### Checked Checkbox
```blade
<x-checkbox-input 
    name="subscribe" 
    label="Subscribe to newsletter" 
    :checked="true" 
/>
```

### Disabled Checkbox
```blade
<x-checkbox-input 
    name="disabled_option" 
    label="This option is disabled" 
    :disabled="true" 
/>
```

### Checkbox with Value
```blade
<x-checkbox-input 
    name="interests[]" 
    value="sports" 
    label="Sports" 
/>
<x-checkbox-input 
    name="interests[]" 
    value="music" 
    label="Music" 
/>
```

### Inline Checkboxes
```blade
<x-checkbox-input 
    name="option1" 
    label="Option 1" 
    :inline="true" 
/>
<x-checkbox-input 
    name="option2" 
    label="Option 2" 
    :inline="true" 
/>
```

### Checkbox with Description
```blade
<x-checkbox-input 
    name="premium" 
    label="Premium Account" 
    description="Unlock all features with a premium subscription" 
/>
```

### Checkbox without Label
```blade
<x-checkbox-input name="hidden_option" />
```

### Checked and Disabled
```blade
<x-checkbox-input 
    name="permanent_option" 
    label="This is permanently enabled" 
    :checked="true" 
    :disabled="true" 
/>
```

## Component Parameters

| Parameter | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | - | Yes | The checkbox's name attribute |
| `label` | string | null | No | The label text displayed next to the checkbox |
| `value` | string | null | No | The value attribute (useful for multiple checkboxes) |
| `checked` | boolean | false | No | Whether the checkbox is checked by default |
| `disabled` | boolean | false | No | Whether the checkbox is disabled |
| `inline` | boolean | false | No | Whether to display inline (form-check-inline class) |
| `description` | string | null | No | Additional description text shown below the label |
| `id` | string | (name) | No | Custom ID for the checkbox (defaults to name parameter) |

## Additional Attributes

The component supports any additional HTML attributes through Laravel's `$attributes` bag:

```blade
<x-checkbox-input 
    name="option" 
    label="Option" 
    class="custom-class"
    data-custom="value"
/>
```

## Examples from the Project

### Before (Traditional HTML)
```blade
<label class="form-check">
    <input class="form-check-input" type="checkbox" name="accept" />
    <span class="form-check-label">Accept terms</span>
</label>
```

### After (Using Component)
```blade
<x-checkbox-input name="accept" label="Accept terms" />
```

### Before (Checkbox with Description)
```blade
<label class="form-check">
    <input class="form-check-input" type="checkbox" />
    <span class="form-check-label">Default checkbox</span>
    <span class="form-check-description">Lorem ipsum dolor sit amet</span>
</label>
```

### After (Using Component)
```blade
<x-checkbox-input 
    name="option" 
    label="Default checkbox" 
    description="Lorem ipsum dolor sit amet" 
/>
```

## Benefits

1. **Less Code**: Reduces 3-4 lines to a single line
2. **Consistency**: Ensures all checkboxes follow the same structure and styling
3. **Maintainability**: Changes to checkbox structure only need to be made in one place
4. **Readability**: Clear, declarative syntax
5. **Accessibility**: Proper label-input associations with automatic ID generation
6. **Form Repopulation**: Automatic integration with Laravel's `old()` helper

## Location

- **Component Class**: `app/View/Components/CheckboxInput.php`
- **Blade Template**: `resources/views/components/checkbox-input.blade.php`
- **Tests**: `tests/Feature/CheckboxInputComponentTest.php`

## Testing

Run the component tests:
```bash
php artisan test --filter CheckboxInputComponentTest
```

All tests should pass with the following coverage:
- Basic rendering
- Checked state
- Disabled state
- Value attribute
- Inline layout
- Description text
- Without label
- Combined states (checked and disabled)
