<?php

namespace App\Entities;

class Muser extends BaseEntity
{
    /**
     * @var int
     */
    private int $Id = 0;

    /**
     * @var Mgroupuser
     */
    private ?Mgroupuser $Mgroupuser  = null;

    /**
     * @var string
     */
    private ?string $Username  = null;

    /**
     * @var string
     */
    private ?string $Password  = null;

    /**
     * @var bool
     */
    private ?bool $IsLoggedIn  = null;

    /**
     * @var bool
     */
    private ?bool $IsActive  = null;


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
     * @return ?Mgroupuser
     */
    protected function getMgroupuser(): ?Mgroupuser
    {
        return $this->Mgroupuser;
    }

    /**
     * @param Mgroupuser $Mgroupuser
     * @return $this
     */
    protected function setMgroupuser(Mgroupuser $Mgroupuser)
    {
        $this->Mgroupuser = $Mgroupuser;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getUsername(): ?string
    {
        return $this->Username;
    }

    /**
     * @param string $Username
     * @return $this
     */
    protected function setUsername(string $Username)
    {
        $this->Username = $Username;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getPassword(): ?string
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     * @return $this
     */
    protected function setPassword(string $Password)
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * @return ?bool
     */
    protected function getIsLoggedIn(): ?bool
    {
        return $this->IsLoggedIn;
    }

    /**
     * @param bool $IsLoggedIn
     * @return $this
     */
    protected function setIsLoggedIn(bool $IsLoggedIn)
    {
        $this->IsLoggedIn = $IsLoggedIn;
        return $this;
    }

    /**
     * @return ?bool
     */
    protected function getIsActive(): ?bool
    {
        return $this->IsActive;
    }

    /**
     * @param bool $IsActive
     * @return $this
     */
    protected function setIsActive(bool $IsActive)
    {
        $this->IsActive = $IsActive;
        return $this;
    }
}
