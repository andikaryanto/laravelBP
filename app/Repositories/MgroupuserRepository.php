<?php

namespace App\Repositories;

use App\Entities\Mgroupuser;
use LaravelOrm\Repository\Repository;

class MgroupuserRepository extends Repository implements MgroupuserRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Mgroupuser::class);
    }
}
