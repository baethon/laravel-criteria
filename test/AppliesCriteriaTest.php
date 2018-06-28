<?php declare(strict_types=1);

namespace Test;

use Baethon\LaravelCriteria\CriteriaInterface;
use Baethon\LaravelCriteria\Traits\AppliesCriteria;

class AppliesCriteriaTest extends \PHPUnit\Framework\TestCase
{
    public function test_model_applies_criteria_to_itself()
    {
        $model = new class () {
            use AppliesCriteria;
        };

        $criteria = $this->createMock(CriteriaInterface::class);
        $criteria->expects($this->once())
            ->method('apply')
            ->with($this->equalTo($model));

        $this->assertSame($model, $model->apply($criteria));
    }
}
