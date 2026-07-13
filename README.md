# E-governance

This repository contains a Laravel-based ward office system for an e-governance project.

The main application is located in `ward-office-system/`.

## Overview

The system supports three user roles:

- Citizen
- Officer
- Admin

It is built to manage document requests, ward office records, and request processing in one place.

## Main Features

- User authentication and role-based access
- Citizen dashboard for submitting and tracking document requests
- Officer dashboard for reviewing and updating requests
- Admin dashboard for managing officers, ward offices, document types, and request oversight
- Request status logging and reference number generation
- Document upload and issued letter handling

## Tech Stack

- Laravel 12
- PHP 8.2+
- Vite
- Tailwind CSS
- Pest for testing

## Setup

1. Open the `ward-office-system/` folder.
2. Install dependencies:

   ```bash
   composer install
   npm install
   ```

3. Create the environment file and generate the app key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations:

   ```bash
   php artisan migrate
   ```

5. Start the development server:

   ```bash
   php artisan serve
   npm run dev
   ```

## Useful Commands

- `composer run setup` for a full install and build
- `composer run dev` to run the app with the frontend assets
- `composer run test` to run the test suite

## Project Structure

- `app/` contains controllers, models, and middleware
- `database/` contains migrations, factories, and seeders
- `resources/` contains views, CSS, and JavaScript
- `routes/` contains the web and auth routes

## Notes

This project is intended for a semester-level e-governance portal and can be extended with more forms, reports, and administrative workflows.
