## Scientiapy

A spiritual successor to the Python-based [Scientiapy](https://github.com/penagos/scientiapy) (an open source Q&A website). Implemented as a Laravel application with Livewire for a responsive user experience.
## Installation

You must have the following installed on your system:
* composer
* PHP 8+
* Web server of your choice capable of serving PHP
* MySQL

```
git clone https://www.github.com/penagos/scientiapy2
cd scientiapy2
composer install
chmod 
cp .env.example .env
sudo chmod -R 777 storage bootstrap/cache
php artisan key:generate
npm run dev
```

## Sample Apache Configuration

Setup a new Apache virtual host with the following contents (assuming you have already correctly configured an SSL certificate for your server):

```
<VirtualHost *:443>
    <Directory "/location/to/scientiapy2/">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
        Require all granted
    </Directory>

    ServerName your.server.com
    DocumentRoot /location/to/scientiapy2/public
    ErrorLog /location/to/error.log
    CustomLog /location/to/requests.log combined
</VirtualHost>
```

## Migrating from Scientiapy (legacy)

There will be a PHP script you can run to import your data from the Python Scientiapy framework into this framework.

## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
