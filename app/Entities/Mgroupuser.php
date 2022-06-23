<?php

namespace App\Entities;

use LaravelOrm\Entities\EntityList;

class Mgroupuser extends BaseEntity
{
    /**
     * @var int
     */
    private int $Id = 0;

    /**
     * @var EntityList
     */
    private ?EntityList $Musers  = null;

    /**
     * @var string
     */
    private ?string $GroupName  = null;

    /**
     * @var string
     */
    private ?string $Description  = null;


    /**
     * @return ?int
     */
    protected function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     * @return $this
     */
    protected function setId(int $Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return ?EntityList
     */
    protected function getMusers(): ?EntityList
    {
        return $this->Musers;
    }

    /**
     * @param EntityList $Musers
     * @return Mgroupuser
     */
    protected function setMusers(EntityList $Musers): Mgroupuser
    {
        $this->Musers = $Musers;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getGroupName(): ?string
    {
        return $this->GroupName;
    }

    /**
     * @param string $GroupName
     * @return $this
     */
    protected function setGroupName(string $GroupName)
    {
        $this->GroupName = $GroupName;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getDescription(): ?string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     * @return $this
     */
    protected function setDescription(string $Description)
    {
        $this->Description = $Description;
        return $this;
    }
}
