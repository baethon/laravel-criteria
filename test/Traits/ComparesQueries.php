<?php

declare(strict_types=1);

namespace Test\Traits;

trait ComparesQueries
{
    public function assertEqualQueries($expected, $actual)
    {
        $this->assertSame($expected->toSql(), $actual->toSql());
        $this->assertSame($expected->getBindings(), $actual->getBindings());
    }
}
