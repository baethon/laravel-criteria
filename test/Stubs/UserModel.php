<?php

declare(strict_types=1);

namespace Test\Stubs;

class UserModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';

    use \Baethon\LaravelCriteria\Traits\AppliesCriteria;
}
