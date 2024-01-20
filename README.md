# Laravel Project README

This README file provides instructions on how to set up and run the Laravel project.

## Prerequisites

Before you begin, ensure you have the following software installed on your machine:

- [PHP](https://www.php.net/) (>= 8.2)
- [Composer](https://getcomposer.org/)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/nadahamed225/Encopedia
    ```

2. Change into the project directory:

    ```bash
    cd Encopedia
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to create a new `.env` file:

    ```bash
    cp .env.example .env
    ```

5. Update the `.env` file with your database credentials and other configuration settings.

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

8. Install JavaScript dependencies:

    ```bash
    npm install
    ```

9. Compile assets:

    ```bash
    npm run dev
    ```

## Running the Application

1. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

   The application will be accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000).

2. Visit the URL in your browser to see the application.

## Troubleshooting

If you encounter any issues, refer to the Laravel documentation or community forums for assistance.
