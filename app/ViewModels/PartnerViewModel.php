<?php

namespace App\ViewModels;

use App\Entities\Partner;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractViewModel;

class PartnerViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Partner
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {

        $user = $this->entity->getUser();
        if ($user) {
            $element['user'] = (new UserViewModel($user))->toArray();
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->entity->getId(),
        ];
    }
}
