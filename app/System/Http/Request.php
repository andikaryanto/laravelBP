<?php

namespace App\System\Http;

use App\Entities\Partner;
use App\Entities\Shop;
use App\Repositories\PartnerRepository;
use LaravelCommon\System\Http\Request as HttpRequest;

class Request extends HttpRequest
{
    /**
     * Undocumented variable
     *
     * @var ?Partner
     */
    protected ?Partner $partner = null;

    /**
     * Get partner of user
     *
     * @return ?Partner
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * Undocumented function
     *
     * @param Partner $partner
     * @return self
     */
    public function setPartner(Partner $partner): Request
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return Shop
     */
    public function getPartnerShop(): Shop
    {
        return $this->getPartner()->getPartnerShops()->first()->getShop();
    }
}
