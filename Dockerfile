# Use the official PHP image from Docker Hub
FROM php:8.0-apache

# Install additional PHP extensions if necessary (e.g., PDO for database support)
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory inside the container to where the web files will be
WORKDIR /var/www/html

# Copy all your project files (the current directory) into the working directory inside the container
COPY . .

# Expose port 8080 (Render or other platforms will use this port for HTTP traffic)
EXPOSE 8080

# Start the Apache web server when the container is launched
CMD ["apache2-foreground"]
