 # Define la imagen base
FROM wordpress:latest

# Copia tus archivos de WordPress al contenedor
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html/

# Instala dependencias adicionales si es necesario
# RUN apt-get update && apt-get install -y <nombre del paquete>

# Define las variables de entorno necesarias
ENV WORDPRESS_DB_HOST=localhost \
    WORDPRESS_DB_USER=root \
    WORDPRESS_DB_PASSWORD=root \
    WORDPRESS_DB_NAME=local \
    WORDPRESS_DB_CHARSET=utf8 \
    WORDPRESS_DB_COLLATE=""

# Expone el puerto en el que se ejecuta WordPress
EXPOSE 80

# Comando de inicio para ejecutar WordPress
CMD ["apache2-foreground"]