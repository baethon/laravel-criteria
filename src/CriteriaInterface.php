<?php

declare(strict_types=1);

namespace Baethon\LaravelCriteria;

use Illuminate\Database\Eloquent\Builder;

interface CriteriaInterface
{
    public function apply(Builder $query);
}
