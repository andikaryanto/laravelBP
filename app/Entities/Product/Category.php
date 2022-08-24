<?php
namespace App\Entities\Product;

use LaravelCommon\App\Entities\BaseEntity;

class Category extends BaseEntity
{
	protected ?string $name = null;
	protected ?string $description = null;

	/**
	 * Set name 
	 *
	 * @param string name
	 * @return self
	 */
	protected function setName(string $name): Category
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get name 
	 *
	 * @return string
	 */
	protected function getName(): string 
	{
		return $this->name;
 	}
 
	/**
	 * Set description 
	 *
	 * @param ?string description
	 * @return self
	 */
	protected function setDescription(?string $description): Category
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * Get description 
	 *
	 * @return ?string
	 */
	protected function getDescription(): ?string 
	{
		return $this->description;
 	}


}
        