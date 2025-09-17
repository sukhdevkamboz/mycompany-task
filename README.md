# Laravel Custom Artisan Command

A simple Laravel project demonstrating a custom Artisan command implementation.

## 📋 Description

This project includes a custom Artisan command for Laravel that performs specific tasks from the command line interface (CLI). It can be extended to fit any automation, data processing, or utility needs in your Laravel application.

## ⚙️ Prerequisites

- PHP >= 8.2 
- Composer  
- Laravel 12  
- MySQL (if database interaction is required)

## 🚀 Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/sukhdevkamboz/mycompany-task.git
    ```

2. Navigate to the project directory:
    ```bash
    cd mycompany-task
    ```

3. Install dependencies:
    ```bash
    composer install
    ```

4. Set up the environment configuration:
    ```bash
    cp .env.example .env
    ```

5. Generate application key:
    ```bash
    php artisan key:generate
    ```

6. Configure database in `.env` if needed.

## ✅ Usage

### Run the custom command

```bash
php artisan migrate
php artisan ser
