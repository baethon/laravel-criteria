<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Collection;

use Baethon\LaravelCriteria\CriteriaInterface;

class AllOfCriteriaCollection implements CriteriaInterface
{
    use CollectionTrait;

    public function apply($query)
    {
        $query->where(function ($innerQuery) {
            foreach ($this->criteria as $criteria) {
                $criteria->apply($innerQuery);
            }
        });
    }
}
