<?php
namespace App\Entities\Product;

use App\Entities\Product;
use LaravelCommon\App\Entities\BaseEntity;

class Variant extends BaseEntity
{
	protected ?Product $product = null;
	protected ?string $name = null;
	protected ?float $price = 0.00;
	protected ?int $stock = 0;
	protected ?int $saleableStock = 0;
	protected ?string $condition = null;
	protected ?float $weight = 0.00;
	protected ?float $height = 0.00;
	protected ?float $width = 0.00;
	protected ?float $length = 0.00;

	/**
	 * Set product 
	 *
	 * @param Product product
	 * @return self
	 */
	protected function setProduct(Product $product): Variant
	{
		$this->product = $product;
		return $this;
	}

	/**
	 * Get product 
	 *
	 * @return Product
	 */
	protected function getProduct(): Product 
	{
		return $this->product;
 	}

	/**
	 * Set name 
	 *
	 * @param string name
	 * @return self
	 */
	public function setName(string $name): Variant
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get name 
	 *
	 * @return string
	 */
	public function getName(): string 
	{
		return $this->name;
 	}

	/**
	 * Set price 
	 *
	 * @param float price
	 * @return self
	 */
	public function setPrice(float $price): Variant
	{
		$this->price = $price;
		return $this;
	}

	/**
	 * Get price 
	 *
	 * @return float
	 */
	public function getPrice(): float 
	{
		return $this->price;
 	}

	/**
	 * Set stock 
	 *
	 * @param int stock
	 * @return self
	 */
	public function setStock(int $stock): Variant
	{
		$this->stock = $stock;
		return $this;
	}

	/**
	 * Get stock 
	 *
	 * @return int
	 */
	public function getStock(): int 
	{
		return $this->stock;
 	}

	/**
	 * Set condition 
	 *
	 * @param string condition
	 * @return self
	 */
	public function setCondition(string $condition): Variant
	{
		$this->condition = $condition;
		return $this;
	}

	/**
	 * Get condition 
	 *
	 * @return string
	 */
	public function getCondition(): string 
	{
		return $this->condition;
 	}

	/**
	 * Set weight 
	 *
	 * @param ?float weight
	 * @return self
	 */
	public function setWeight(?float $weight): Variant
	{
		$this->weight = $weight;
		return $this;
	}

	/**
	 * Get weight 
	 *
	 * @return ?float
	 */
	public function getWeight(): ?float 
	{
		return $this->weight;
 	}

	/**
	 * Set height 
	 *
	 * @param ?float height
	 * @return self
	 */
	public function setHeight(?float $height): Variant
	{
		$this->height = $height;
		return $this;
	}

	/**
	 * Get height 
	 *
	 * @return ?float
	 */
	public function getHeight(): ?float 
	{
		return $this->height;
 	}

	/**
	 * Set width 
	 *
	 * @param ?float width
	 * @return self
	 */
	public function setWidth(?float $width): Variant
	{
		$this->width = $width;
		return $this;
	}

	/**
	 * Get width 
	 *
	 * @return ?float
	 */
	public function getWidth(): ?float 
	{
		return $this->width;
 	}

	/**
	 * Set length 
	 *
	 * @param ?float length
	 * @return self
	 */
	public function setLength(?float $length): Variant
	{
		$this->length = $length;
		return $this;
	}

	/**
	 * Get length 
	 *
	 * @return ?float
	 */
	public function getLength(): ?float 
	{
		return $this->length;
 	}



	/**
	 * Get the value of saleableStock
	 */ 
	public function getSaleableStock(): int
	{
		return $this->saleableStock;
	}

	/**
	 * Set the value of saleableStock
	 *
	 * @return  self
	 */ 
	public function setSaleableStock(int $saleableStock): Variant
	{
		$this->saleableStock = $saleableStock;

		return $this;
	}
}
        