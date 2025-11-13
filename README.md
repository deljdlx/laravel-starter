# Laravel Starter

A modern Laravel starter project with pre-configured settings and best practices to help you kickstart your web application development.

## Overview

This Laravel starter project provides a solid foundation for building modern web applications. It comes with a clean setup and follows Laravel best practices, allowing you to focus on building your application rather than configuring the basics.

## Features

- **Latest Laravel Framework** - Built on the latest version of Laravel
- **Clean Architecture** - Organized folder structure following Laravel conventions
- **Development Ready** - Pre-configured for immediate development
- **Modern Stack** - Includes Vite for asset bundling
- **Testing Setup** - PHPUnit configured and ready to use

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

## Testing

Run the test suite:

```bash
php artisan test
```

Or use PHPUnit directly:

```bash
vendor/bin/phpunit
```

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
