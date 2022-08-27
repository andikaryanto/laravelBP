<?php

namespace App\Entities;

use App\Repositories\WarehouseRepository;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelOrm\Exception\EntityException;

class Warehouse extends BaseEntity
{
    /**
     * Undocumented variable
     *
     * @var ?string
     */
    private ?string $name = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $description = null;


    /**
     * Get undocumented variable
     *
     * @return  string
     */
    protected function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $name
     *
     * @return  Warehouse
     */
    protected function setName(string $name): Warehouse
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */
    protected function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null
     *
     * @return  self
     */
    protected function setDescription(?string $description): Warehouse
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function validate()
    {
        parent::validate();

        $params = [
            'where' => [
                ['name', '=', $this->getName()]
            ]
        ];

        if (!empty($this->getId())) {
            $params['where'][] = ['id', '<>', $this->getId()];
        }

        $repo = new WarehouseRepository();
        $result = $repo->findOne($params);
        if (!empty($result)) {
            throw new EntityException('data with the name "' . $this->getName() . '" exists');
        }
    }
}
