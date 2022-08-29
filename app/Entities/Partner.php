<?php
namespace App\Entities;

use App\Entities\Partner\Shop as PartnerShop;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\User;
use LaravelOrm\Entities\EntityList;

class Partner extends BaseEntity
{
	protected ?User $user = null;
	protected ?EntityList $partnerShops = null;

	/**
	 * Get the value of user
	 * @return User
	 */ 
	protected function getUser(): ?User
	{
		return $this->user;
	}

	/**
	 * Set the value of user
	 *
	 * @param User $user
	 * @return  self
	 */ 
	protected function setUser(User $user): self
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * Get the value of partnerShops
	 */ 
	protected function getPartnerShops(): ?EntityList
	{
		return $this->partnerShops;
	}

	/**
	 * Set the value of partnerShops
	 *
	 * @return  self
	 */ 
	protected function setPartnerShops(EntityList $partnerShops): self
	{
		$this->partnerShops = $partnerShops;

		return $this;
	}
}
        