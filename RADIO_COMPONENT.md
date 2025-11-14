# RadioInput Component Documentation

## Overview
The `RadioInput` component is a reusable Laravel Blade component designed to simplify form creation by providing a clean, consistent interface for radio button input fields.

## Features
- Configurable label, name, and value
- Support for checked and disabled states
- Inline layout support
- Optional description text
- Automatic ID generation based on name and value (can be overridden)
- Full support for additional HTML attributes via `$attributes`
- Integration with Laravel's `old()` helper for form repopulation

## Basic Usage

### Simple Radio Buttons
```blade
<div class="mb-3">
    <div class="form-label">Gender</div>
    <div>
        <x-radio-input name="gender" value="male" label="Male" />
        <x-radio-input name="gender" value="female" label="Female" />
        <x-radio-input name="gender" value="other" label="Other" />
    </div>
</div>
```

### Radio with Checked State
```blade
<x-radio-input 
    name="plan" 
    value="premium" 
    label="Premium Plan" 
    :checked="true" 
/>
```

### Disabled Radio Button
```blade
<x-radio-input 
    name="option" 
    value="disabled" 
    label="This option is disabled" 
    :disabled="true" 
/>
```

### Inline Radio Buttons
```blade
<x-radio-input 
    name="size" 
    value="small" 
    label="Small" 
    :inline="true" 
/>
<x-radio-input 
    name="size" 
    value="medium" 
    label="Medium" 
    :inline="true" 
/>
<x-radio-input 
    name="size" 
    value="large" 
    label="Large" 
    :inline="true" 
/>
```

### Radio with Description
```blade
<x-radio-input 
    name="subscription" 
    value="monthly" 
    label="Monthly Subscription" 
    description="Billed monthly at $9.99/month" 
/>
```

### Radio without Label
```blade
<x-radio-input name="hidden_option" value="hidden" />
```

### Checked and Disabled
```blade
<x-radio-input 
    name="locked_option" 
    value="default" 
    label="Default option (locked)" 
    :checked="true" 
    :disabled="true" 
/>
```

## Component Parameters

| Parameter | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | - | Yes | The radio button's name attribute (same for all in a group) |
| `value` | string | - | Yes | The value attribute (unique for each option) |
| `label` | string | null | No | The label text displayed next to the radio button |
| `checked` | boolean | false | No | Whether the radio button is checked by default |
| `disabled` | boolean | false | No | Whether the radio button is disabled |
| `inline` | boolean | false | No | Whether to display inline (form-check-inline class) |
| `description` | string | null | No | Additional description text shown below the label |
| `id` | string | (name_value) | No | Custom ID for the radio (defaults to name_value) |

## Additional Attributes

The component supports any additional HTML attributes through Laravel's `$attributes` bag:

```blade
<x-radio-input 
    name="option" 
    value="1" 
    label="Option 1" 
    class="custom-class"
    data-custom="value"
/>
```

## Examples from the Project

### Before (Traditional HTML)
```blade
<label class="form-check">
    <input class="form-check-input" type="radio" name="choice" checked />
    <span class="form-check-label">Option 1</span>
</label>
<label class="form-check">
    <input class="form-check-input" type="radio" name="choice" />
    <span class="form-check-label">Option 2</span>
</label>
```

### After (Using Component)
```blade
<x-radio-input name="choice" value="1" label="Option 1" :checked="true" />
<x-radio-input name="choice" value="2" label="Option 2" />
```

### Before (Inline Radios)
```blade
<label class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="option" checked />
    <span class="form-check-label">Yes</span>
</label>
<label class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="option" />
    <span class="form-check-label">No</span>
</label>
```

### After (Using Component)
```blade
<x-radio-input name="option" value="yes" label="Yes" :checked="true" :inline="true" />
<x-radio-input name="option" value="no" label="No" :inline="true" />
```

## Benefits

1. **Less Code**: Reduces 3-4 lines to a single line per radio button
2. **Consistency**: Ensures all radio buttons follow the same structure and styling
3. **Maintainability**: Changes to radio button structure only need to be made in one place
4. **Readability**: Clear, declarative syntax
5. **Type Safety**: Component requires both name and value parameters
6. **Accessibility**: Proper label-input associations with automatic ID generation
7. **Form Repopulation**: Automatic integration with Laravel's `old()` helper

## Important Notes

- All radio buttons in a group **must have the same `name`** attribute
- Each radio button in a group **must have a unique `value`** attribute
- Only one radio button in a group can be checked at a time
- The ID is automatically generated as `{name}_{value}` to ensure uniqueness

## Location

- **Component Class**: `app/View/Components/RadioInput.php`
- **Blade Template**: `resources/views/components/radio-input.blade.php`
- **Tests**: `tests/Feature/RadioInputComponentTest.php`

## Testing

Run the component tests:
```bash
php artisan test --filter RadioInputComponentTest
```

All tests should pass with the following coverage:
- Basic rendering
- Checked state
- Disabled state
- Inline layout
- Description text
- Without label
- Combined states (checked and disabled)
- Multiple radio buttons with same name
