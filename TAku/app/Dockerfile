## Use the official Nginx image as the base image
FROM nginx:latest

RUN docker-php-ext-install mysqli

## Copy the default Nginx configuration file
COPY default.conf /etc/nginx/conf.d/default.conf

## Copy the web application code to the container
COPY .app/ /var/www/html/

## Expose port 80 for HTTP traffic
EXPOSE 80
