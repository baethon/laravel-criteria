<?php

declare(strict_types=1);

namespace Test;

use Baethon\LaravelCriteria\Collection\CriteriaCollection;
use Test\Stubs\CompareCriteria;
use Test\Traits\ComparesQueries;
use Test\Traits\UsesDatabase;

class AllOfCriteriaCollectionTest extends \PHPUnit\Framework\TestCase
{
    use UsesDatabase;
    use ComparesQueries;

    public function test_it_applies_criteria()
    {
        $query = $this->capsule->table('users');
        $expected = $this->capsule->table('users')
            ->where(function ($query) {
                $query->where('name', 'Jon');
                $query->where('lastname', 'Snow');
            });

        CriteriaCollection::allOf([
            CompareCriteria::create('name', 'Jon'),
            CompareCriteria::create('lastname', 'Snow'),
        ])->apply($query);

        $this->assertEqualQueries($expected, $query);
    }
}
