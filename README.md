# OrthodoxCalendarLibary

# Opzetten project
Instellen van mod rewrite in console:
```
sudo a2enmod rewrite
```
Herstarten van apache2
```
sudo systemctl restart apache2
```
Instellen van .htaccess
```
RewriteEngine on
RewriteRule ^(\d{4})/(0?[1-9]|1[0-2])/(0?[1-9]|[12][0-9]|3[01])/?$ backend/index.php?y=$1&m=$2&d=$3
```
