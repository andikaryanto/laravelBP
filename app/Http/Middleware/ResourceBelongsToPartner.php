<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;

/**
 * Set partner shop to request if request come from user token who is partner
 *
 */
class ResourceBelongsToPartner
{
    public const NAME = 'resource-belongs-to-partner';

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
        if ($shop->getId() != $resource->getShop()->getId()) {
            throw new ResponsableException("Resource doesn't belongs to this partner", new NoDataFoundResponse(""));
        }
        return $next($request);
    }
}
