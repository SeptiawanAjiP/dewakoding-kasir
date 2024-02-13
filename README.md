# Dewakoding Kasir

![image](https://raw.githubusercontent.com/SeptiawanAjiP/dewakoding-kasir/master/image.jpeg)

Dewakoding Kasir is a simple Point of Sale (POS) or cashier application built using Laravel, Livewire 3, and Bootstrap. This application is designed to help small business owners manage their sales transactions more efficiently.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)

## Features

- Product management: Easily add, edit, and delete products.
- Sales transactions

## Installation

1. Clone the repository:

    ```bash
    https://github.com/SeptiawanAjiP/dewakoding-kasir.git
    ```

2. Navigate to the project directory:

    ```bash
    cd your-project
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env` and configure your database:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```
6. Create symlink

    ```bash
    php artisan storage:link
    ```

7. Migrate the database:

    ```bash
    php artisan migrate --seed
    ```

8. Start the development server:

    ```bash
    php artisan serve
    ```

### Usage

Visit `http://localhost:8000` in your browser to access the web-based landing page generator.
