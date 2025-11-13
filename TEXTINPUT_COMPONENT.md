# TextInput Component Documentation

## Overview
The `TextInput` component is a reusable Laravel Blade component designed to simplify form creation by providing a clean, consistent interface for text-based input fields.

## Features
- Support for multiple input types: text, password, email, url, tel, number
- Configurable label and name
- Optional placeholder and default value
- Support for required, disabled, and readonly states
- Optional label description/counter
- Automatic ID generation based on name (can be overridden)
- Full support for additional HTML attributes via `$attributes`

## Basic Usage

### Simple Text Input
```blade
<x-text-input 
    name="email" 
    label="Email" 
    type="email" 
    placeholder="Enter your email" 
/>
```

### Password Input
```blade
<x-text-input 
    name="password" 
    label="Password" 
    type="password" 
    placeholder="Enter password" 
/>
```

### Required Field
```blade
<x-text-input 
    name="username" 
    label="Username" 
    :required="true" 
/>
```

### With Default Value
```blade
<x-text-input 
    name="company" 
    label="Company" 
    value="Acme Inc." 
/>
```

### Disabled Field
```blade
<x-text-input 
    name="id" 
    label="ID" 
    value="12345" 
    :disabled="true" 
/>
```

### Readonly Field
```blade
<x-text-input 
    name="created_at" 
    label="Created Date" 
    value="2025-01-01" 
    :readonly="true" 
/>
```

### With Label Description
```blade
<x-text-input 
    name="bio" 
    label="Bio" 
    description="120/200" 
/>
```

### Without Label (Label-less Input)
```blade
<x-text-input 
    name="search" 
    placeholder="Search..." 
/>
```

## Component Parameters

| Parameter | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | - | Yes | The input's name attribute |
| `label` | string | null | No | The label text displayed above the input (optional) |
| `type` | string | 'text' | No | Input type (text, password, email, url, tel, number) |
| `placeholder` | string | null | No | Placeholder text for the input |
| `value` | string | null | No | Default value for the input |
| `required` | boolean | false | No | Whether the field is required |
| `disabled` | boolean | false | No | Whether the field is disabled |
| `readonly` | boolean | false | No | Whether the field is readonly |
| `description` | string | null | No | Additional description text shown next to the label |
| `id` | string | (name) | No | Custom ID for the input (defaults to name parameter) |

## Additional Attributes

The component supports any additional HTML attributes through Laravel's `$attributes` bag:

```blade
<x-text-input 
    name="email" 
    label="Email" 
    class="custom-class"
    data-custom="value"
/>
```

## Examples from the Project

### Before (Traditional HTML)
```blade
<div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Email" />
</div>
```

### After (Using Component)
```blade
<x-text-input name="email" label="Email address" type="email" placeholder="Email" />
```

## Benefits

1. **Less Code**: Reduces 5-6 lines to a single line
2. **Consistency**: Ensures all inputs follow the same structure and styling
3. **Maintainability**: Changes to input structure only need to be made in one place
4. **Readability**: Clear, declarative syntax
5. **Type Safety**: Component validates input types
6. **Accessibility**: Proper label-input associations with automatic ID generation

## Location

- **Component Class**: `app/View/Components/TextInput.php`
- **Blade Template**: `resources/views/components/text-input.blade.php`
- **Tests**: `tests/Feature/TextInputComponentTest.php`

## Testing

Run the component tests:
```bash
php artisan test --filter TextInputComponentTest
```

All tests should pass with the following coverage:
- Basic rendering
- Required state
- Disabled state
- Readonly state
- Label description
