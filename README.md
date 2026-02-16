# Laravel Starter

A modern Laravel starter project with pre-configured settings and best practices to help you kickstart your web application development.

## Overview

This Laravel starter project provides a solid foundation for building modern web applications. It comes with a clean setup and follows Laravel best practices, allowing you to focus on building your application rather than configuring the basics.

## Features

- **Latest Laravel Framework** - Built on Laravel 12
- **Clean Architecture** - Organized folder structure following Laravel conventions
- **Development Ready** - Pre-configured for immediate development
- **Modern Stack** - Includes Vite for asset bundling and Tailwind CSS
- **Testing Setup** - PHPUnit configured and ready to use
- **UI Components** - Tabler UI integration with ready-to-use components
- **Charts & Visualization** - ECharts, ApexCharts for data visualization
- **Interactive Components** - Alpine.js for reactive UI elements
- **Form Validation** - Pre-configured validation with Laravel FormRequest
- **User Management** - CRUD example with pagination and search


## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL or other supported database

## Installation

1. Clone the repository:
```bash
git clone https://github.com/deljdlx/laravel-starter.git
cd laravel-starter
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create your environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file

7. Run migrations:
```bash
php artisan migrate
```

## Development

Start the development server:

```bash
php artisan serve
```

Build assets for development:

```bash
npm run dev
```

## Demo Pages

The project includes several demo pages showcasing different features:

- **Home (`/`)** - Overview with links to all available routes
- **Users CRUD (`/users`)** - Complete user management with pagination and search
- **Component Demos (`/demo/components`)** - Interactive showcase of:
  - **Alpine.js** - Reactive components and interactivity examples
  - **Forms** - Tabler UI form components and validation
  - **Diagrams** - Mermaid.js diagram rendering
  - **ECharts** - Interactive data visualization charts
  - **ApexCharts** - Modern charting library examples
  - **Tabulator** - Advanced data table with sorting and filtering
  - **Tabler UI** - Complete UI component library showcase
- **Model Builder (`/dev/model-builder`)** - Visual tool for generating Laravel models, migrations, and factories

## Testing

Run the full test suite:

```bash
php artisan test
```

Or use PHPUnit directly:

```bash
vendor/bin/phpunit
```

Run specific test suites:

```bash
# Run only feature tests
php artisan test --testsuite=Feature

# Run only unit tests
php artisan test --testsuite=Unit

# Run a specific test file
php artisan test tests/Feature/ModelBuilderControllerTest.php

# Run tests with detailed output
php artisan test --testdox

# Run tests with coverage (requires Xdebug)
php artisan test --coverage
```

### Model Builder Tests

The Model Builder feature includes comprehensive integration tests:

```bash
# Run all Model Builder tests
php artisan test --filter ModelBuilderControllerTest

# Run with detailed output
php artisan test --filter ModelBuilderControllerTest --testdox
```

**Test Coverage:**
- ✅ Model generation with various attribute types
- ✅ Migration generation with timestamps and soft deletes
- ✅ Factory generation with type-aware faker data
- ✅ Foreign key relationships (belongsTo, hasOne, hasMany, belongsToMany)
- ✅ Pivot table generation for many-to-many relationships
- ✅ HasStatuses trait integration (Spatie)
- ✅ Validation rules enforcement
- ✅ Prevention of model overwrites

**Note:** Tests automatically clean up generated files (models, migrations, factories) before and after each test to ensure isolation.

## Building for Production

Build assets for production:

```bash
npm run build
```

Optimize the application:

```bash
php artisan optimize
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
