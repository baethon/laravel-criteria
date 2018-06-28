<?php declare(strict_types=1);

namespace Test\Traits;

trait ComparesQueries
{
    public function assertEqualQueries($expected, $actual)
    {
        $this->assertEquals($expected->toSql(), $actual->toSql());
        $this->assertEquals($expected->getBindings(), $actual->getBindings());
    }
}
