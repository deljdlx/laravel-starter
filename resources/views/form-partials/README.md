# Form Components Decomposition

This directory contains the decomposed parts of the main `form.blade.php` file.

## Purpose

The original `form.blade.php` file was a monolithic 2085-line file containing all form element examples. It has been broken down into reusable partials that can be:
- Easily maintained
- Reused across different views
- Converted into Laravel components in the future

## Component Optimization

### TextInput Component

Many of the basic text/password inputs in these partials have been refactored to use the new `TextInput` Laravel component for improved code reusability and maintainability.

**Before:**
```blade
<div class="mb-3">
  <label class="form-label">Email</label>
  <input type="email" class="form-control" name="email" placeholder="Email" />
</div>
```

**After:**
```blade
<x-text-input label="Email" name="email" type="email" placeholder="Email" />
```

See [TEXTINPUT_COMPONENT.md](/TEXTINPUT_COMPONENT.md) for full documentation.

## Structure

The form has been divided into 17 logical partials:

### Column 1 - Basic Form Elements

#### basic-inputs.blade.php
Contains fundamental input types:
- Static text display
- Text input (using TextInput component)
- Password input (using TextInput component)
- Disabled input (using TextInput component)
- Readonly input (using TextInput component)
- Required input (using TextInput component)
- Textarea

#### select-inputs.blade.php
Contains select element variations:
- Simple select
- Multiple select
- States select (multi-select with US states)

#### input-groups.blade.php
Contains input groups with buttons and dropdowns:
- Input with button
- Input with dropdown
- Input group with button dropdowns

#### icon-inputs.blade.php
Contains inputs with icon decorations:
- Icon input (search, user icons)
- Loader/spinner inputs

#### separated-inputs.blade.php
Contains inputs with additional elements:
- Input with separate button
- Input with help icon/popover

### Column 1 (continued) - Advanced Input Styles

#### form-control-variants.blade.php
Contains form control style variations:
- Rounded form controls
- Flush form controls

#### input-addons.blade.php
Contains inputs with various addons:
- Prepended/appended text
- Inputs with checkboxes/radios
- Inputs with links
- Inputs with kbd elements
- Inputs with icon links

#### floating-inputs.blade.php
Contains floating label inputs:
- Floating email input
- Floating password input
- Floating select

### Column 2 - Visual Form Elements

#### image-check.blade.php
Contains image-based selection inputs:
- Image checkbox grid
- Image radio grid

#### color-inputs.blade.php
Contains color selection inputs:
- Color checkbox inputs
- Color radio inputs (rounded)
- Color picker

#### validation-states.blade.php
Contains form validation state examples:
- Valid/invalid states
- Lite validation states

#### form-fieldset.blade.php
Contains grouped form fields:
- Complete fieldset example with multiple fields

#### selectgroups-buttons.blade.php
Contains advanced selection and button groups:
- Simple selectgroups
- Icon selectgroups
- Selectgroups with icons and text
- Pill-style selectgroups
- Payment method selection boxes
- Project manager selection
- Button groups (basic, dropdown, vertical)
- Toolbar button groups

### Column 3 - Interactive Elements

#### radios-checkboxes.blade.php
Contains radio and checkbox inputs:
- Radio buttons (normal and inline)
- Checkboxes (normal and inline)
- Checkboxes with descriptions
- Toggle switches
- Notification toggles

#### file-date-masks.blade.php
Contains file and date-related inputs:
- File input
- Date of birth selector (month/day/year dropdowns)
- Input masks (date, telephone)
- Autosize textarea

#### datalist-advanced-selects.blade.php
Contains advanced input types:
- Datalist
- Range inputs
- Datepickers
- Progress bars
- Form buttons (social login)
- Tags input
- Advanced selects (with avatars, flags, labels, etc.)

### Additional Forms

#### additional-forms.blade.php
Contains complete form examples:
- Project ID form
- Node.js Version form
- Basic form (email/password/select/checkboxes)
- Input mask form
- My Profile form
- Edit Profile form

## Usage

These partials are included in the main `form.blade.php` file using Laravel's `@include` directive:

```blade
@include('form-partials.basic-inputs')
@include('form-partials.select-inputs')
// ... etc
```

## Future Enhancement

These partials can be converted to Laravel Blade components with the following benefits:
- Pass dynamic data via props
- Use slots for flexible content
- Add component-level logic
- Create a reusable component library

Example conversion from partial to component:

```blade
{{-- Current partial usage --}}
@include('form-partials.basic-inputs')

{{-- Future component usage --}}
<x-form.basic-inputs 
    :values="$formData" 
    :errors="$errors"
/>
```

## File Size Comparison

- Original `form.blade.php`: 110KB (2085 lines)
- New `form.blade.php`: 2.0KB (57 lines)
- Reduction: ~98% smaller main file

## Maintenance

When updating form elements:
1. Locate the appropriate partial file
2. Make changes to that specific partial
3. Changes are automatically reflected in `form.blade.php`
