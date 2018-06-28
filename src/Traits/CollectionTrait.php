<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria\Traits;

use Baethon\LaravelCriteria\CriteriaInterface;

trait CollectionTrait
{
    private $criteria = [];

    private function __construct(CriteriaInterface ...$criteria)
    {
        $this->criteria = $criteria;
    }

    public static function create(array $criteria): self
    {
        return new static(...$criteria);
    }
}
