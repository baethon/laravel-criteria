<?php declare(strict_types=1);

namespace Test\Collection;

use Test\Traits\UsesDatabase;
use Test\Traits\ComparesQueries;
use Test\Stubs\CompareCriteria;
use Baethon\LaravelCriteria\Collection\CriteriaCollection;

class OneOfCriteriaCollectionTest extends \PHPUnit\Framework\TestCase
{
    use UsesDatabase;

    use ComparesQueries;

    public function test_it_applies_criteria()
    {
        $query = $this->capsule->table('users');
        $expected = $this->capsule->table('users')
            ->where(function ($query) {
                $query->orWhere(function ($innerQuery) {
                    $innerQuery->where('name', 'Jon');
                });
                $query->orWhere(function ($innerQuery) {
                    $innerQuery->where('lastname', 'Snow');
                });
            });

        CriteriaCollection::oneOf([
            CompareCriteria::create('name', 'Jon'),
            CompareCriteria::create('lastname', 'Snow'),
        ])->apply($query);

        $this->assertEqualQueries($expected, $query);
    }
}
