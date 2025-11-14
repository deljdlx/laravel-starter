# SelectInput Component Documentation

## Overview
The `SelectInput` component is a reusable Laravel Blade component designed to simplify form creation by providing a clean, consistent interface for select dropdown fields. This component handles both single and multiple selections, with proper support for placeholders and selected state management.

## Features
- Configurable label, name, and options
- Support for single and multiple selections
- Optional placeholder (for single selects only)
- Support for selected state (single value or array for multiple)
- Support for required and disabled states
- Optional description text
- Automatic ID generation based on name (can be overridden)
- Full support for additional HTML attributes via `$attributes`
- Integration with Laravel's `old()` helper for form repopulation
- Proper handling of placeholder visibility and selection state

## Basic Usage

### Simple Select Dropdown
```blade
<x-select-input 
    name="country" 
    label="Country" 
    :options="[
        'us' => 'United States',
        'ca' => 'Canada',
        'mx' => 'Mexico'
    ]" 
/>
```

### Select with Selected Value
```blade
<x-select-input 
    name="size" 
    label="Size" 
    :options="[
        's' => 'Small',
        'm' => 'Medium',
        'l' => 'Large'
    ]" 
    selected="m" 
/>
```

### Select with Placeholder
```blade
<x-select-input 
    name="color" 
    label="Color" 
    :options="[
        'red' => 'Red',
        'blue' => 'Blue',
        'green' => 'Green'
    ]" 
    placeholder="Select a color" 
/>
```

### Required Select
```blade
<x-select-input 
    name="plan" 
    label="Subscription Plan" 
    :options="[
        'free' => 'Free',
        'basic' => 'Basic',
        'pro' => 'Pro'
    ]" 
    :required="true" 
/>
```

### Disabled Select
```blade
<x-select-input 
    name="status" 
    label="Status" 
    :options="[
        'active' => 'Active',
        'inactive' => 'Inactive'
    ]" 
    :disabled="true" 
/>
```

### Multiple Select
```blade
<x-select-input 
    name="tags" 
    label="Tags" 
    :options="[
        'php' => 'PHP',
        'javascript' => 'JavaScript',
        'python' => 'Python',
        'ruby' => 'Ruby'
    ]" 
    :multiple="true" 
/>
```

### Multiple Select with Selected Values
```blade
<x-select-input 
    name="skills" 
    label="Skills" 
    :options="[
        'html' => 'HTML',
        'css' => 'CSS',
        'js' => 'JavaScript',
        'php' => 'PHP'
    ]" 
    :selected="['html', 'css', 'js']" 
    :multiple="true" 
/>
```

### Select with Description
```blade
<x-select-input 
    name="tier" 
    label="Membership Tier" 
    :options="[
        'bronze' => 'Bronze',
        'silver' => 'Silver',
        'gold' => 'Gold'
    ]" 
    description="Choose your membership level" 
/>
```

### Select without Label
```blade
<x-select-input 
    name="filter" 
    :options="[
        'all' => 'All Items',
        'active' => 'Active Only',
        'archived' => 'Archived Only'
    ]" 
/>
```

### Using with Dynamic Options (from database)
```blade
<x-select-input 
    name="category_id" 
    label="Category" 
    :options="$categories->pluck('name', 'id')->toArray()" 
    placeholder="Select a category"
    :required="true"
/>
```

## Component Parameters

| Parameter | Type | Default | Required | Description |
|-----------|------|---------|----------|-------------|
| `name` | string | - | Yes | The select's name attribute |
| `options` | array | [] | No | Key-value pairs for select options (value => text) |
| `selected` | string\|array\|null | null | No | Selected value(s) - string for single, array for multiple |
| `label` | string\|null | null | No | The label text displayed above the select |
| `placeholder` | string\|null | null | No | Placeholder text (only for single select, not multiple) |
| `required` | boolean | false | No | Whether the field is required |
| `disabled` | boolean | false | No | Whether the field is disabled |
| `multiple` | boolean | false | No | Whether to allow multiple selections |
| `description` | string\|null | null | No | Additional description text shown next to the label |
| `id` | string\|null | (name) | No | Custom ID for the select (defaults to name parameter) |

## Additional Attributes

The component supports any additional HTML attributes through Laravel's `$attributes` bag:

```blade
<x-select-input 
    name="priority" 
    label="Priority" 
    :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']"
    class="custom-class"
    data-action="update-priority"
/>
```

## Examples from the Project

### Before (Traditional HTML)
```blade
<div class="mb-3">
    <label class="form-label">Country</label>
    <select class="form-select" name="country">
        <option value="">Select a country</option>
        <option value="us">United States</option>
        <option value="ca">Canada</option>
        <option value="mx">Mexico</option>
    </select>
</div>
```

### After (Using Component)
```blade
<x-select-input 
    name="country" 
    label="Country" 
    :options="['us' => 'United States', 'ca' => 'Canada', 'mx' => 'Mexico']"
    placeholder="Select a country"
/>
```

### Before (Multiple Select)
```blade
<div class="mb-3">
    <label class="form-label required">Tags</label>
    <select class="form-select" name="tags[]" multiple required>
        <option value="php" selected>PHP</option>
        <option value="js">JavaScript</option>
        <option value="python" selected>Python</option>
    </select>
</div>
```

### After (Using Component)
```blade
<x-select-input 
    name="tags" 
    label="Tags" 
    :options="['php' => 'PHP', 'js' => 'JavaScript', 'python' => 'Python']"
    :selected="['php', 'python']"
    :multiple="true"
    :required="true"
/>
```

## Important Notes

### Placeholder Behavior
- Placeholders are **only shown for single selects**, not multiple selects
- When a placeholder is present, it appears as a disabled, hidden option
- The placeholder is automatically selected when no value is selected
- When a value is selected (via `selected` prop or `old()` data), the placeholder is not selected

### Multiple Select Behavior
- When `multiple` is true, the name is automatically appended with `[]` (e.g., `tags` becomes `tags[]`)
- The `selected` parameter accepts an array of values for multiple selects
- No placeholder is shown for multiple selects (as per standard HTML behavior)

### Form Repopulation
- The component automatically integrates with Laravel's `old()` helper
- After form validation errors, the component will restore previously selected values
- The `old()` values take precedence over the `selected` prop

### Options Format
- Options should be provided as an associative array: `['value' => 'Display Text']`
- The array keys become option values, and array values become displayed text
- You can use collection methods like `pluck()` to format database results

## Benefits

1. **Less Code**: Reduces 5-8 lines to a single component tag
2. **Consistency**: Ensures all selects follow the same structure and styling
3. **Maintainability**: Changes to select structure only need to be made in one place
4. **Readability**: Clear, declarative syntax
5. **Type Safety**: Component validates parameters and handles edge cases
6. **Accessibility**: Proper label-select associations with automatic ID generation
7. **Form Repopulation**: Automatic integration with Laravel's `old()` helper
8. **Smart Placeholder**: Automatic handling of placeholder visibility and selection state

## Location

- **Component Class**: `app/View/Components/SelectInput.php`
- **Blade Template**: `resources/views/components/select-input.blade.php`
- **Tests**: `tests/Feature/SelectInputComponentTest.php`

## Testing

Run the component tests:
```bash
php artisan test --filter SelectInputComponentTest
```

All tests should pass with the following coverage:
- Basic rendering with options
- Selected state (single value)
- Selected state (multiple values)
- Placeholder rendering and behavior
- Required state
- Disabled state
- Multiple select mode
- Description text
- Without label
- Empty options array
- Placeholder not selected when value is selected
