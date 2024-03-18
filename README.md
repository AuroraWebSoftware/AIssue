# **Laravel AIssue Package**

The Laravel AIssue package provides a comprehensive solution for managing issues within your Laravel applications. Built with flexibility and extensibility in mind, it integrates seamlessly with Laravel's Eloquent ORM, offering a rich set of features to handle issue tracking, state management, and connections between different models.

## **Features**

- **Customizable Issue Tracking**: Track issues with customizable fields, descriptions, summaries, and timestamps.
- **Workflow Integration**: Utilize the ArFlow package for state management of issues, allowing for complex workflows with multiple states and transitions.
- **Dynamic Relationships**: Leverage the Connective package for dynamic relationships between issues and various actors (e.g., reporters, responsible parties, observers).
- **Event Management**: Incorporate event management for issues, including setting due dates and reminders, through integration with the ACalendar package.
- **Extensible and Modular**: Designed with modularity in mind, allowing for easy extension and customization to fit your application's specific needs.

## **Installation**

You can install the package via composer:

```bash
composer require aurorawebsoftware/aissue

```

After installation, publish and run the migrations with:

```bash
php artisan vendor:publish --provider="AuroraWebSoftware\AIssue\AIssueServiceProvider" --tag="migrations"
php artisan migrate

```

## **Usage**

### **Basic Concepts**

Before diving into the code, it's essential to understand the main components of the AIssue package:

- **Issues**: The central entity representing a problem or task that needs to be addressed.
- **Actors**: Entities such as users who interact with issues in different capacities (e.g., reporter, responsible party).
- **Workflow States**: Define the lifecycle of an issue through various states (e.g., open, in progress, closed).

### **Defining and Managing Issues**

Create a new issue:

```php
use AuroraWebSoftware\AIssue\Models\AIssue;

$issue = AIssue::create([
    'summary' => 'Example issue',
    'description' => 'Detailed description of the issue',
]);

// Apply a predefined workflow
$issue->applyWorkflow('simple');

```

Add actors to an issue:

```php
// Assuming $user1 and $user2 are instances of a Model that implements IssueActorModelContract
$issue->setReporter($user1); // Set the reporter
$issue->setResponsible($user2); // Set the responsible party

```

Manage issue states:

```php
// Transition to another state
$issue->transitionTo('state2');

// Check current state
$currentState = $issue->currentState();

```

### **Working with Connectives and Observers**

```php
// Add observers to an issue
$issue->addObserver($user3);
$issue->addObserver($user4);

// Remove an observer
$issue->removeObserver($user3);

// Remove all observers
$issue->removeAllObservers();

```

### **Setting and Managing Due Dates**

```php
use Illuminate\Support\Carbon;

// Set a due date for the issue
$issue->setDueDate(Carbon::today());

// Remove the due date
$issue->removeDueDate();

```

## **Advanced Usage**

The AIssue package supports more advanced features and integrations, allowing for a highly customizable issue tracking system. For more details on these advanced features, please refer to the comprehensive documentation.

## **Contributing**

Contributions are welcome and will help make AIssue even better. If you're interested in contributing, please check out the contributing guide.

## **License**

The Laravel AIssue package is open-sourced software licensed under the [MIT license](https://chat.openai.com/g/g-8MaB2KpKn-laravel-developer/c/LICENSE.md).

---

This README provides a solid foundation for your Laravel AIssue package, outlining its capabilities, how to get started, and how to use its main features. You can further customize and expand it based on the specific details and additional functionalities of your package.