<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Setup from a Clone

Follow these instructions to set up the JDS project on a local development machine.

### Requirements

Make sure the following are installed:

- PHP 8.4+
- Composer
- Node.js and npm
- MySQL or another database supported by the project
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/reyjager/jds.git
cd jds
```

### 2. Install Dependencies

Install the PHP and JavaScript dependencies:

```bash
composer install
npm install
```

### 3. Configure the Environment

Create your local environment file:

```bash
copy .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Open `.env` and configure the following settings for your local environment:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

Make sure the database exists before proceeding.

**Important:** Never commit your `.env` file or expose passwords, API keys, or other credentials.

### 4. Set Up the Database

Run the database migrations and seeders:

```bash
php artisan migrate --seed
```

Create the public storage link:

```bash
php artisan storage:link
```

If the project uses a database other than MySQL, configure the appropriate connection in `.env`.

### 5. Build Frontend Assets

Build the frontend assets for local use:

```bash
npm run build
```

During development, you can instead run the Vite development server:

```bash
npm run dev
```

Keep the Vite development server running while developing the frontend.

### 6. Start the Application

Run the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

http://127.0.0.1:8000

If the server uses a different port, open the URL displayed in your terminal.

### 7. Run Tests

Run the Laravel test suite:

```bash
php artisan test
```

Check the frontend build:

```bash
npm run build
```

### 8. Additional Verification

Run the following commands when checking changes before submitting a pull request:

```bash
php artisan view:cache
git diff --check
```

If you modify `resources/js/app.js`, check its JavaScript syntax:

```bash
node --check resources/js/app.js
```

### Troubleshooting

**Composer dependency errors**

Check your PHP version:

```bash
php -v
composer check-platform-reqs
```

Make sure your PHP version satisfies the project's dependencies.

**Database connection errors**

- Confirm that your database server is running.
- Verify the database name and credentials in `.env`.
- Make sure the database exists.
- Run migrations again if necessary.

**Missing application key**

```bash
php artisan key:generate
```

**Frontend assets are missing**

```bash
npm install
npm run build
```

**Configuration changes are not taking effect**

Clear Laravel's cached configuration:

```bash
php artisan optimize:clear
```

### Development Guidelines

- Create a feature branch before making changes.
- Follow the existing project structure and coding conventions.
- Reuse shared components for consistent UI behavior.
- Run relevant tests before submitting changes.
- Review your Git diff before committing.
- Never commit `.env`, `vendor/`, or `node_modules/`.

### Contributing Changes

Create a feature branch:

```bash
git switch -c feat/your-feature-name
```

Review your changes:

```bash
git status
git diff
```

Stage and commit your changes:

```bash
git add .
git commit -m "feat: describe your changes"
```

Push the branch:

```bash
git push -u origin feat/your-feature-name
```

Then open a Pull Request on GitHub targeting the `main` branch. Include a summary of the changes, relevant test results, and screenshots for UI changes.