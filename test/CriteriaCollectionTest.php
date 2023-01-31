<?php

declare(strict_types=1);

namespace Test;

use Baethon\LaravelCriteria\Collection\CriteriaCollection;
use Test\Stubs\CompareCriteria;
use Test\Traits\ComparesQueries;
use Test\Traits\UsesDatabase;

class CriteriaCollectionTest extends \PHPUnit\Framework\TestCase
{
    use UsesDatabase;
    use ComparesQueries;

    public function test_it_applies_criteria_to_query()
    {
        $query = $this->capsule->table('users');
        $collection = CriteriaCollection::create([
            CompareCriteria::create('name', 'Jon'),
            CompareCriteria::create('lastname', 'Snow'),
        ]);

        $collection->apply($query);

        $expectedQuery = $this->capsule->table('users')
            ->where('name', 'Jon')
            ->where('lastname', 'Snow');

        $this->assertEqualQueries($expectedQuery, $query);
    }
}
