<?php

namespace App\Entities;

use LaravelOrm\Entities\EntityList;

class Groupuser extends BaseEntity
{
    /**
     * @var int
     */
    private int $Id = 0;

    /**
     * @var EntityList
     */
    private ?EntityList $Users  = null;

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
    protected function getUsers(): ?EntityList
    {
        return $this->Users;
    }

    /**
     * @param EntityList $Users
     * @return $this
     */
    protected function setUsers(EntityList $Users)
    {
        $this->Users = $Users;
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
