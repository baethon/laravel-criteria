<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Traits;

use Baethon\LaravelCriteria\CriteriaInterface;

trait AppliesCriteria
{
    public function scopeApply($query, CriteriaInterface $criteria)
    {
        $criteria->apply($query);

        return $query;
    }
}
