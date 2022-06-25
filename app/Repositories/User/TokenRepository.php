<?php

namespace App\Repositories\User;

use App\Entities\User\Token;
use LaravelOrm\Repository\Repository;

class TokenRepository extends Repository implements TokenRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Token::class);
    }
}
