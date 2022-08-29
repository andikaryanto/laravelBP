<?php
namespace App\Entities;

use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\User;

class Partner extends BaseEntity
{
	protected ?User $user = null;

	/**
	 * Get the value of user
	 * @return User
	 */ 
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * Set the value of user
	 *
	 * @param User $user
	 * @return  self
	 */ 
	public function setUser(User $user): self
	{
		$this->user = $user;

		return $this;
	}
}
        