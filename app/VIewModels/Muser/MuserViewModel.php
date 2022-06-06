<?php

namespace App\ViewModels\Muser;

use App\Entities\Mgroupuser;
use App\Entities\Muser;
use LaravelCommon\ViewModels\AbstractViewModel;
use App\ViewModels\Mgroupuser\MgroupuserViewModel;
use LaravelOrm\Entities\EntityList;
use stdClass;

class MuserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Muser
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {
        /**
         * @var Mgroupuser $groupuser
         */
        $groupuser = $this->entity->getMgroupuser();
        if (!empty($groupuser)) {
            $element['Groupuser'] = (new MgroupuserViewModel($groupuser))->toArray();
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'Id' => $this->entity->getId(),
            'Username' => $this->entity->getUsername(),
            "IsActive" => (bool)$this->entity->getIsActive()
        ];
    }
}
