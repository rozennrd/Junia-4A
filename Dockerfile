FROM nginx:latest

# Install PHP and required extensions
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    apt-transport-https lsb-release ca-certificates curl && \
    curl -sSLo '/usr/share/keyrings/deb.sury.org-php.gpg' 'https://packages.sury.org/php/apt.gpg' && \
    echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > '/etc/apt/sources.list.d/php.list' && \
    apt-get update && \
    apt-get install -y \
    php8.1-fpm php8.1-bcmath php8.1-curl php8.1-mbstring php8.1-pdo php8.1-mysql php8.1-xml && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Ensure Nginx config folder exists
RUN mkdir -p /data/conf

# Copy Nginx config
COPY ./nginx.conf /data/conf/nginx.conf

# Copy application code
WORKDIR /var/www/html
COPY ./src/* .

# Expose port 80
EXPOSE 80

# Create an entrypoint script to start services
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Use the entrypoint script
ENTRYPOINT ["/entrypoint.sh"]
