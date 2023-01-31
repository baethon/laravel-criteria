<?php

declare(strict_types=1);

namespace Test\Stubs;

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

    public static function create(string $field, string $value)
    {
        return new static($field, $value);
    }

    public function apply($query)
    {
        $query->where($this->field, $this->value);
    }
}
