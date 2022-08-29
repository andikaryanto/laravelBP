<?php

namespace App\Repositories;

use App\Entities\Partner;
use App\Repositories\PartnerRepositoryInterface;
use App\ViewModels\PartnerCollection;
use App\ViewModels\PartnerViewModel;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\BaseRepository;

class PartnerRepository extends BaseRepository implements PartnerRepositoryInterface
{
    /**
     * Constrcutor
     */
    public function __construct()
    {
        parent::__construct(Partner::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return PartnerCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return PartnerViewModel::class;
    }

    public function getPartnerByUser(User $user)
    {
        return $this->findOne([
            'where' => [
                ['user_id', '=', $user->getId()]
            ]
        ]);
    }
}
