# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copia todo el contenido de tu repo al directorio raíz del servidor
COPY . /var/www/html/

# Expone el puerto 80
EXPOSE 80
