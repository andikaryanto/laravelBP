<?php
namespace App\Entities;

use LaravelCommon\App\Entities\BaseEntity;

class Warehouse extends BaseEntity {
    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $name;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $description;


    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    protected function getName(): string
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
    protected function setDescription($description): Warehouse
    {
        $this->description = $description;

        return $this;
    }
}