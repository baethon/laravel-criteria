<?php declare(strict_types=1);

namespace Test;

use Test\Traits\UsesDatabase;
use Test\Traits\ComparesQueries;
use Test\Stubs\CompareCriteria;
use Baethon\LaravelCriteria\Collection\CriteriaCollection;

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
