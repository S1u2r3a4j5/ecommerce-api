# Step 1: Use a PHP image with FPM
FROM php:8.1-fpm

# Step 2: Set the working directory in the container
WORKDIR /var/www

# Step 3: Install necessary libraries and extensions for Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Step 4: Install Composer to manage PHP dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 5: Install git (Required for some Laravel packages)
RUN apt-get install -y git

# Step 6: Copy the application files into the container
COPY . .

# Step 7: Install Laravel's PHP dependencies using Composer
RUN composer install --no-scripts --no-autoloader

# Step 8: Set up the .env file from the example
RUN cp .env.example .env

# Step 9: Set up storage and bootstrap cache directory permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Step 10: Set up correct file permissions for Laravel
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Step 11: Expose the PHP-FPM port
EXPOSE 9000

# Step 12: Start PHP-FPM to serve the application
CMD ["php-fpm"]
