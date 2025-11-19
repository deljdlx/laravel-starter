# Tabler CSS Variables Customization

This project includes a comprehensive Tabler CSS variables override system that makes it easy to customize the Tabler theme without needing to explore the original Tabler source files.

## Files

- **`resources/css/tabler-variables.scss`** - Contains all Tabler SCSS variables with their default values, ready to be customized
- **`resources/css/tabler.scss`** - Main Tabler import file that includes the custom variables

## How to Use

### 1. Basic Customization

To customize Tabler, simply open `resources/css/tabler-variables.scss` and uncomment the variables you want to modify:

```scss
// Example: Change the primary color
$primary: #ff5733 !default;

// Example: Adjust font family
$font-family-sans-serif: "Arial", sans-serif !default;

// Example: Modify border radius
$border-radius: 12px !default;
```

### 2. Available Variable Categories

The `tabler-variables.scss` file is organized into the following sections:

- **Base Config** - Feature toggles and basic configuration
- **Dark Mode** - Dark mode settings
- **Fonts** - Font families, sizes, and weights
- **Icons** - Icon settings
- **Colors** - All color variables (grays, theme colors, backgrounds, etc.)
- **Spacing** - Margins, paddings, and spacers
- **Components** - All UI component variables (buttons, cards, forms, modals, etc.)
- **Grid & Layout** - Container and grid settings
- **Utilities** - Miscellaneous utility settings

### 3. Common Customizations

#### Change Theme Colors
```scss
$primary: #066fd1 !default;
$success: #2fb344 !default;
$danger: #d63939 !default;
$warning: #f59f00 !default;
```

#### Adjust Spacing
```scss
$spacer: 1rem !default;
$card-spacer-y: 1.5rem !default;
$card-spacer-x: 1.5rem !default;
```

#### Modify Typography
```scss
$font-size-base: 1rem !default;
$h1-font-size: 2rem !default;
$font-weight-bold: 700 !default;
```

#### Update Border Radius
```scss
$border-radius: 8px !default;
$border-radius-lg: 12px !default;
$border-radius-sm: 4px !default;
```

### 4. Build Process

After making changes to `tabler-variables.scss`:

1. Run the development server:
   ```bash
   npm run dev
   ```

2. Or build for production:
   ```bash
   npm run build
   ```

The custom variables will be automatically applied to the Tabler styles during the build process.

## How It Works

1. **Variable Override**: The `tabler-variables.scss` file contains all Tabler variables with the `!default` flag. This means they will only be used if not already defined.

2. **Import Order**: The `tabler.scss` file imports files in this specific order:
   - First: Your custom variables (`tabler-variables.scss`)
   - Then: Tabler core styles (which use your custom variables)
   - Finally: Tabler vendors (additional components)

3. **Build Integration**: The `resources/js/bootstrap.js` file imports `tabler.scss`, which triggers the SCSS compilation with your custom variables.

## Tips

- **Start Small**: Uncomment and customize only the variables you need. Don't uncomment everything at once.
- **Check Defaults**: All variables include their default values as comments, making it easy to see what you're changing.
- **Use !default**: Keep the `!default` flag on your custom variables to maintain the override hierarchy.
- **Test Changes**: Always test your changes in both light and dark modes (if enabled).

## Examples

### Complete Color Scheme Change

```scss
// Primary brand colors
$blue: #1e40af !default;
$primary: $blue !default;

// Adjust gray scale for better contrast
$gray-100: #f5f5f5 !default;
$gray-500: #737373 !default;
$gray-800: #262626 !default;
```

### Modern Rounded Design

```scss
$border-radius: 12px !default;
$border-radius-lg: 16px !default;
$border-radius-sm: 8px !default;
$btn-border-radius: 24px !default;
$card-border-radius: 16px !default;
```

### Compact Layout

```scss
$font-size-base: 0.8125rem !default;
$spacer: 0.75rem !default;
$btn-padding-y: 0.25rem !default;
$btn-padding-x: 0.625rem !default;
$card-spacer-y: 1rem !default;
$card-spacer-x: 1rem !default;
```

## Reference

For a complete list of all Tabler variables and their usage, refer to:
- [Tabler Official Documentation](https://tabler.io/docs)
- [Tabler GitHub Repository](https://github.com/tabler/tabler)

All 800+ variables from Tabler are documented in `tabler-variables.scss` with their default values and organized by category for easy discovery.
