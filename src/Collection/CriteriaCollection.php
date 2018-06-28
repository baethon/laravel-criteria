<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Collection;

use Baethon\LaravelCriteria\CriteriaInterface;

class CriteriaCollection implements CriteriaInterface
{
    use CollectionTrait;

    public static function oneOf(array $criteria): OneOfCriteriaCollection
    {
        return OneOfCriteriaCollection::create($criteria);
    }

    public function apply($query)
    {
        foreach ($this->criteria as $criteria) {
            $criteria->apply($query);
        }
    }
}
