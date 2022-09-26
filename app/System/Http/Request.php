<?php

namespace App\System\Http;

use App\Entities\Partner;
use App\Entities\Shop;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\BadRequestResponse;
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
        if ($this->getPartner()->getPartnerShops()->count() == 0) {
            throw new ResponsableException('', new BadRequestResponse('Partner does not have related shop(s)'));
        }
        return $this->getPartner()->getPartnerShops()->first()->getShop();
    }
}
