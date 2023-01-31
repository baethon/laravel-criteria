<?php

declare(strict_types=1);

namespace Test\Traits;

use Illuminate\Database\Capsule\Manager as Capsule;

trait UsesDatabase
{
    private $capsule;

    /**
     * @before
     */
    public function setupDatabaseCapsule()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'sqlite',
            'database' => 'php://memory',
            'prefix' => '',
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
