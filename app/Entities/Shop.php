<?php
namespace App\Entities;

use App\Repositories\ShopRepository;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelOrm\Exception\EntityException;

class Shop extends BaseEntity {
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
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $address = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $phone = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $personalInformation = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $longitude = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $latitude = null;


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
     * @return  Shop
     */ 
    protected function setName(string $name): Shop
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
    protected function setDescription(?string $description): Shop
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

        if(!empty($this->getId())){
            $params['where'][] = ['id', '<>', $this->getId()];
        }

        $repo = new ShopRepository();
        $result = $repo->findOne($params);
        if(!empty($result)){
            throw new EntityException('data with the name "' . $this->getName() . '" exists');
        }
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */ 
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null  $address  Undocumented variable
     *
     * @return  self
     */ 
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */ 
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null  $phone  Undocumented variable
     *
     * @return  self
     */ 
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */ 
    public function getPersonalInformation(): ?string
    {
        return $this->personalInformation;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null  $personalInformation  Undocumented variable
     *
     * @return  self
     */ 
    public function setPersonalInformation(?string $personalInformation): self
    {
        $this->personalInformation = $personalInformation;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */ 
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null  $longitude  Undocumented variable
     *
     * @return  self
     */ 
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */ 
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null  $latitude  Undocumented variable
     *
     * @return  self
     */ 
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
}