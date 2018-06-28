# baethon/laravel-criteria

Minimal implementation of [criteria pattern](https://www.tutorialspoint.com/design_pattern/filter_pattern.htm) for Laravel.

## What is criteria?

Criteria is an implementation of `\Baethon\LaravelCriteria\CriteriaInterface` which is responsible for only one thing - modify Laravels query in a specified way.

This allows to decouple and re-use query modifiers.

Criteria are very similar to [Eloquent scopes](https://laravel.com/docs/eloquent#query-scopes). The main difference is that they can be applied to different models across the application.

## Installation

```php
composer require baethon/laravel-criteria
```

## Laravel compatibility

This library has no dependencies to Laravel itself. It should work with all versions of Laravel.

## Usage

First, you need to create an implementation of `CriteriaInterface`:

```php
<?php

use Baethon\LaravelCriteria\CriteriaInterface;

class CompareCriteria implements CriteriaInterface
{
    private $field;

    private $value;

    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($query)
    {
        $query->where($this->field, $this->value);
    }
}
```

Now, you can *apply* it to the query:

```php
$query = User::query();

(new CompareCriteria('name', 'Jon'))->apply($query);

$jon = $query->first();
```

### AppliesCriteria trait

To simplify things it's possible to use `AppliesCriteria` trait in a model.

```php
use Baethon\LaravelCriteria\Traits\AppliesCriteria;

class User extends Model
{
    // model body stripped for better readability

    use AppliesCriteria;
}

$jon = User::query()
    ->apply(new CompareCriteria('name', 'Jon'))
    ->first();
```

### Collections

The package provides collections which allow applying multiple criteria at once.

To apply group of criteria use `\Baethon\LaravelCriteria\Collections\CriteriaCollection`:

```php
$jonSnow = User::query()
    ->apply(CriteriaCollection::create([
        new CompareCriteria('name', 'Jon'),
        new CompareCriteria('lastname', 'Snow'),
    ]))
    ->first();

// same result, without CriteriaCollection
$jonSnow = User::query()
    ->apply(new CompareCriteria('name', 'Jon'))
    ->apply(new CompareCriteria('lastname', 'Snow'))
    ->first();
```

If you need to be sure that all criteria will be fulfilled you can use `CriteriaCollection::allOf()`:

```php
User::query()
    ->apply(CriteriaCollection::allOf([
        new CompareCriteria('name', 'Jon'),
        new CompareCriteria('lastname', 'Snow'),
    ]));

// same as
User::query()
    ->where(function ($query) {
        $query->apply(new CompareCriteria('name', 'Jon'))
            ->apply(new CompareCriteria('lastname', 'Snow'));
    });
```

Also, you can group criteria using logical `OR` join:

```php
User::query()
    ->apply(CriteriaCollection::oneOf([
        new CompareCriteria('name', 'Jon'),
        new CompareCriteria('lastname', 'Snow'),
    ]));

// same as
User::query()
    ->where(function ($query) {
        $query->where('name', 'Jon')
            ->orWhere('lastname', 'Snow');
    });
```

## Testing

Run tests with:

```bash
./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see License File for more information.
