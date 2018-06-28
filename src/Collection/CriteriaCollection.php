<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Collection;

use Baethon\LaravelCriteria\CriteriaInterface;

class CriteriaCollection implements CriteriaInterface
{
    private $criteria = [];

    private function __construct(CriteriaInterface ...$criteria)
    {
        $this->criteria = $criteria;
    }

    public static function create(array $criteria): self
    {
        return new CriteriaCollection(...$criteria);
    }

    public function apply($query)
    {
        foreach ($this->criteria as $criteria) {
            $criteria->apply($query);
        }
    }
}
