<?php

namespace App\Http\Middleware;

use App\Repositories\PartnerRepository;
use Closure;
use Illuminate\Http\Request;

class SetPartnerToRequest
{
    public const NAME = 'set-partner-to-request';

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
        $user = $request->getUserToken()->getUser();
        $partner = $this->partnerRepository->getPartnerByUser($user);
        if (!is_null($partner)) {
            $request->setPartner($partner);
        }

        return $next($request);
    }
}
