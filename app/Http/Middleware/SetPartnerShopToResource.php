<?php

namespace App\Http\Middleware;

use App\Repositories\PartnerRepository;
use Closure;
use Illuminate\Http\Request;

/**
 * Set partner shop to request if request come from user token who is partner
 *
 */
class SetPartnerShopToResource
{
    public const NAME = 'set-partner-shop-to-resource';

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
