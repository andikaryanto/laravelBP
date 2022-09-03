<?php

namespace App\Http\Middleware;

use App\Repositories\PartnerRepository;
use Closure;
use Illuminate\Http\Request;

class SetShopToResource
{
    public const NAME = 'set-shop-to-resource';
    /**
     * Undocumented variable
     *
     * @var PartnerRepository
     */
    protected PartnerRepository $partnerRepository;

    public function __construct(
        PartnerRepository $partnerRepository
    ) {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $shop = $request->getPartnerShop();
        $resource = $request->getResource();
        $resource->setShop($shop);
        return $next($request);
    }
}
