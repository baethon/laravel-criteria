<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Traits;

use Baethon\LaravelCriteria\CriteriaInterface;

trait AppliesCriteria
{
    public function apply(CriteriaInterface $criteria)
    {
        $criteria->apply($this);

        return $this;
    }
}
