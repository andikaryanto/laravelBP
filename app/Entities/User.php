<?php
namespace App\Entities;

use LaravelCommon\App\Entities\User as EntitiesUser;

class User extends EntitiesUser {

    protected ?Shop $shop = null;

    /**
     * Get the value of shop
     */ 
    protected function getShop(): Shop
    {
        return $this->shop;
    }

    /**
     * Set the value of shop
     *
     * @return  self
     */ 
    protected function setShop(Shop $shop)
    {
        $this->shop = $shop;

        return $this;
    }
}