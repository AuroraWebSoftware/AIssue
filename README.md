# AIssue for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aurorawebsoftware/aissue.svg?style=flat-square)](https://packagist.org/packages/aurorawebsoftware/aissue)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/aurorawebsoftware/aissue/run-tests?label=tests)](https://github.com/aurorawebsoftware/aissue/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/aurorawebsoftware/aissue/Check%20&%20fix%20styling?label=code%20style)](https://github.com/aurorawebsoftware/aissue/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/aurorawebsoftware/aissue.svg?style=flat-square)](https://packagist.org/packages/aurora/aissue)

Todo ....

# Features

- Todo ...

---


[<img src="https://banners.beyondco.de/AIssue.png?theme=light&packageManager=composer+require&packageName=aurorawebsoftware%2Faissue&pattern=architect&style=style_1&description=Model+Issue+Management+Package&md=1&showWatermark=0&fontSize=100px&images=check-circle" />](https://github.com/AuroraWebSoftware/Aissue)

# Installation

You can install the package via composer:

```bash
composer require aurorawebsoftware/aissue
```

Todo

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use AuroraWebSoftware\aissue\Traits\aissueUser;

class User extends Authenticatable
{
    use ;

    // ...
}
```

You can publish and run the migrations with:

```bash
php artisan migrate
```

You can publish the sample data seeder with:

```bash
php artisan vendor:publish --tag="aissue-seeders"
php artisan db:seed --class=SampleDataSeeder
```

Optionally, You can seed the sample data with:

```bash
php artisan db:seed --class=SampleDataSeeder
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="aissue-config"
```

This is the example contents of the published config file:

```php
return [
];
```

# Main Philosophy
Todo

---
> If you don't need organizational roles, **aissue** may not be suitable for your work.
---

# Aissue Terminology

Before using aissue its worth to understand the main terminology of aissue.
aissue differs from other Auth Packages due to its organizational structure.


# Usage

Before using this, please make sure that you published the config files.


## aissue Service and Facade Methods

### todo

```php

```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently....

## Contributing

Please see [CONTRIBUTING](README-contr.md) for details.

## Security Vulnerabilities

// todo ?
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.


## Credits

- [Aurora Web Software Team](https://github.com/AuroraWebSoftware)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
