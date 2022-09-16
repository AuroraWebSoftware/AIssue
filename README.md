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

You must add AIssueModelTrait Trait to the Issueable Model.

```php
use AuroraWebSoftware\AIssue\Contracts\AIssueModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueModelTrait;

class Issueable extends Model implements AIssueModelContract
{
    use AAuthUser;

    // ...
}
```

You can publish and run the migrations with:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="aissue-config"
```

This is the example contents of the published config file:
```bash

    return [
        'policyMethod' => fn ($permission): bool => true,
        'issueTypes' => [
            'task' => [
                'todo' => ['sort' => 1, 'permission' => 'todo_perm'],
                'in_progress' => ['sort' => 2, 'permission' => 'in_progress_perm'],
                'done' => ['sort' => 3, 'permission' => 'done_perm'],
            ],
        ],
    ];
```

**Permission Config File**

Permissions are stored inside `config/aissue.php` which is published after installing


# Main Philosophy
# 

In some systems, many users interact with each other. these interacting users perform a number of tasks
in a certain order by using the tools that the system allows them. the sequence and result of these 
tasks completed by users are of concern to other users.The results of these tasks should also be reported 
to other relevant users. This package, manages this process, which we call the work flow system, 
and notifies the relevant users.This package manages this process, which we call the workflow system,
and informs the relevant users. also saves process information in database

---
> If you don't need organizational roles, **aissue** may not be suitable for your work.
---

# Aissue Terminology

Before using AIssue its worth to understand the main terminology of AIssue.
The difference of Issue from other packages is that it perform simple-level workflows with its simplified structure.


# Usage

Before using this, please make sure that you published the config files.


## AIssue Services, Service Provider and Facade

## AIssueServiceProvider

Organization Service is used for organization related jobs. The service can be initialized as

```php
    $aissueServiceProvider = new AIssueServiceProvider()
```
or via dependency injecting

```php

    public function index(AIssueServiceProvider $aissueServiceProvider)
{
   
}
```



### Creating an Issuable
```php

$createdModel = Issueable::create(
        ['name' => 'example isuable model']
    );

```

### Making a transition for todo, in_progres and done
```php

    $createdModel = Issueable::create(
            ['name' => 'example isuable model']
        );
    
        /** @var AIssue $createdIssueModel */
        $createdIssueModel = $createdModel->createIssue(1, 1, 'example', 'example isssue', 'example', 1, \Illuminate\Support\Carbon::now());
                                                                                                        //todo,in_progress,done 
        $createdIssueModel->canMakeTransition('todo')

```

### Getting transitionable statuses
```php

    $createdModel = Issueable::create(
        ['name' => 'example isuable model 4']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'example', 'example isssue', 'example', 1, \Illuminate\Support\Carbon::now());
    $transitionable = $createdIssueModel->getTransitionableStatuses($createdIssueModel);

    $this->assertTrue($transitionable == ["todo","in_progress"]);

```

### Using AIssue Interface and Trait with Eloquent Models
To turn an Eloquent Model into an AIssue ; 
Model must implement AIssueModelContract and use AIssueModelTrait Trait.
After adding AIssueModelContract trait, you will be able to use AIssue methods within the model
```php

    namespace App\Models\ExampleModel;

    use AuroraWebSoftware\AIssue\Contracts\AIssueModelContract;
    use AuroraWebSoftware\AIssue\Traits\AIssueModelTrait;
    use Illuminate\Database\Eloquent\Model;
    
    class ExampleModel extends Model implements AIssueModelContract
    {
        use AIssueModelTrait;
    
        // implementation
}

```

Getting All Model Collection without any access control
```php

    ExampleModel::withoutGlobalScopes()->all()

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

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
