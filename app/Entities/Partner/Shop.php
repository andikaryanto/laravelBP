<?php
namespace App\Entities\Partner;

use App\Entities\Partner;
use App\Entities\Shop as EntitiesShop;
use LaravelCommon\App\Entities\BaseEntity;

class Shop extends BaseEntity
{
	protected ?Partner $partner = null;
	protected ?EntitiesShop $shop = null;


	/**
	 * Get the value of partner
	 */ 
	public function getPartner(): Partner
	{
		return $this->partner;
	}

	/**
	 * Set the value of partner
	 *
	 * @return  self
	 */ 
	public function setPartner(Partner $partner): self
	{
		$this->partner = $partner;

		return $this;
	}

	/**
	 * Get the value of shop
	 */ 
	public function getShop(): EntitiesShop
	{
		return $this->shop;
	}

	/**
	 * Set the value of shop
	 *
	 * @return  self
	 */ 
	public function setShop(EntitiesShop $shop): self
	{
		$this->shop = $shop;

		return $this;
	}
}
        