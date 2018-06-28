<?php declare(strict_types=1);

namespace Baethon\LaravelCriteria;

interface CriteriaInterface
{
    public function apply($query);
}
