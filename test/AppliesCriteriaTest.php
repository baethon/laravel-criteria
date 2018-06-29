<?php declare(strict_types=1);

namespace Test;

use Test\Stubs\UserModel;
use Test\Traits\UsesDatabase;
use Test\Stubs\CompareCriteria;
use Test\Traits\ComparesQueries;
use Baethon\LaravelCriteria\CriteriaInterface;
use Baethon\LaravelCriteria\Traits\AppliesCriteria;

class AppliesCriteriaTest extends \PHPUnit\Framework\TestCase
{
    use UsesDatabase;

    use ComparesQueries;

    public function test_model_applies_criteria_to_itself()
    {
        $query = UserModel::query()
            ->apply(CompareCriteria::create('name', 'Jon'));

        $expected = $this->capsule->table('users')
            ->where('name', 'Jon');

        $this->assertEqualQueries($expected, $query);
    }
}
