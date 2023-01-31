<?php

declare(strict_types=1);

namespace Baethon\LaravelCriteria\Collection;

use Baethon\LaravelCriteria\CriteriaInterface;
use Baethon\LaravelCriteria\Traits\CollectionTrait;

class OneOfCriteriaCollection implements CriteriaInterface
{
    use CollectionTrait;

    public function apply($query)
    {
        $query->where(function ($innerQuery) {
            foreach ($this->criteria as $criteria) {
                $innerQuery->orWhere(function ($anotherInnerQuery) use ($criteria) {
                    $criteria->apply($anotherInnerQuery);
                });
            }
        });
    }
}
