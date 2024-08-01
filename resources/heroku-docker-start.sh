#!/usr/bin/env bash

a2dismod mpm_event &&

# Modifica el archivo de configuración de Apache para usar el puerto asignado por Heroku
if [[ -z "${PORT}" ]]; then
  export PORT=80
fi

sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf
apache2-foreground "$@"