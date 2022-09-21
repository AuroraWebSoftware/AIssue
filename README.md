# AIssue for Laravel

Basic and Lean Issue Management Package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aurorawebsoftware/aissue.svg?style=flat-square)](https://packagist.org/packages/aurorawebsoftware/aissue)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/aurorawebsoftware/aissue/run-tests?label=tests)](https://github.com/aurorawebsoftware/aissue/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/aurorawebsoftware/aissue/Check%20&%20fix%20styling?label=code%20style)](https://github.com/aurorawebsoftware/aissue/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/aurorawebsoftware/aissue.svg?style=flat-square)](https://packagist.org/packages/aurora/aissue)


# Features

- Basic Workflow and Issue Management
- Limitless Issue Types
- Limitless Statuses for Issue Types
- Authenticatable Issue Status Transitions
- Easy to Use and Lean
---


[<img src="https://banners.beyondco.de/AIssue.png?theme=light&packageManager=composer+require&packageName=aurorawebsoftware%2Faissue&pattern=architect&style=style_1&description=Model+Issue+Management+Package&md=1&showWatermark=0&fontSize=100px&images=check-circle" />](https://github.com/AuroraWebSoftware/Aissue)

# Installation

You can install the package via composer:

```bash
composer require aurorawebsoftware/aissue
```

You must add AIssueModelTrait Trait to the **Issueable** Model and The model must implement **AIssueModelContract**

```php
use AuroraWebSoftware\AIssue\Contracts\AIssueModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueModelTrait;

class Issueable extends Model implements AIssueModelContract
{
    use AIssueModelTrait;

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

Permissions are stored `config/aissue.php` is published after installing


# Aissue Terminology

Before using AIssue its worth to understand the main terminology of AIssue.
The difference of Issue from other packages is that it perform simple-level workflows with its simplified structure.


# Usage

Before using this, please make sure that you published the config files.


## AIssue Services, Service Provider and Facade


## Terminology

**policyMethod** : It is the definition that provides authorization check before reaching the Issuable.

**IssueType**   : IssueType is Workflow type's name determined by system authority.

**transition** : transition is changing of type example(todo,in_progres,done,etc).

**status** : status is IssueModel's current type type example(todo,in_progres,done,etc).

**Issueable** : Issueable  is an model that contains makeTransition,canMakeTransition,getTransitionableStatuses functions and workflow information.





### Creating an Issuable
```php

$createdModel = Issueable::create(
        ['name' => 'example isuable model']
    );
```

### MakeTransition function in AIssueModel is making transformation for todo,in_progress,done
```php

  
    $createdModel = Issueable::create(
        ['name' => 'test isuable model ']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdf', 1, \Illuminate\Support\Carbon::now());

    $transition = $createdIssueModel->makeTransition('in_progress');


```

### canMakeTransition function in AIssueModel is checking policyMethod permission from config file
```php

    $createdModel = Issueable::create(
            ['name' => 'example isuable model']
        );
    
        /** @var AIssue $createdIssueModel */
        $createdIssueModel = $createdModel->createIssue(1, 1, 'example', 'example isssue', 'example', 1, \Illuminate\Support\Carbon::now());
                                                                                                     
        $createdIssueModel->canMakeTransition('todo')

```

### getTransitionableStatuses function in AIssueModel is getting transitionable statustes from config file if it is got any permission
```php

    $createdModel = Issueable::create(
        ['name' => 'example isuable model 4']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'example', 'example isssue', 'example', 1, \Illuminate\Support\Carbon::now());
    $transitionable = $createdIssueModel->getTransitionableStatuses($createdIssueModel);


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


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](README-contr.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.


## Credits

- [Aurora Web Software Team](https://github.com/AuroraWebSoftware)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
