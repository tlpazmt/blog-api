
### 1. Install project dependencies
    composer install

### 2. Copy .env.example file as .env
    cp .env.example .env

### 3. Start the Docker Environment
    ./vendor/bin/sail up -d

### 4. Run php artisan migrate
    ./vendor/bin/sail php artisan migrate
