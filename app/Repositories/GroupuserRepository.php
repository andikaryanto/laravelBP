<?php

namespace App\Repositories;

use App\Entities\Groupuser;
use LaravelOrm\Repository\Repository;

class GroupuserRepository extends Repository implements GroupuserRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Groupuser::class);
    }
}
