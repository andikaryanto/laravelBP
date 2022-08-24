<?php

namespace App\Repositories;

use App\Entities\User;
use App\Repositories\ShopRepositoryInterface;
use LaravelCommon\App\Repositories\UserRepository as RepositoriesUserRepository;

class UserRepository extends RepositoriesUserRepository implements ShopRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return UserCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return UserViewModel::class;
    }
}