## Scientiapy

## Installation

You must have the following dependencies installed on your system:
* composer

```
git clone https://www.github.com/penagos/scientiapy2
cd scientiapy2
composer install
chmod 
cp .env.example .env
sudo chmod -R 777 storage bootstrap/cache
php artisan key:generate
```

## Migrating from Scientiapy (legacy)

There will be a PHP script you can run to import your data from the Python Scientiapy framework into this framework.

## License

This is open-sourced software licensed under t4he [MIT license](https://opensource.org/licenses/MIT).
