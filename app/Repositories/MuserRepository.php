<?php

namespace App\Repositories;

use App\Entities\Muser;
use LaravelOrm\Repository\Repository;

class MuserRepository extends Repository implements MuserRepositoryInterface
{
 /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Muser::class);
    }
}
