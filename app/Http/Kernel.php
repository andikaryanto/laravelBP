<?php

namespace App\Http;

use App\Http\Middleware\Hydrators\ProductCategoryHydrator;
use App\Http\Middleware\Hydrators\ProductHydrator;
use App\Http\Middleware\Hydrators\ShopHydrator;
use App\Http\Middleware\Hydrators\WarehouseHydrator;
use App\Http\Middleware\ResourceBelongsToPartner;
use App\Http\Middleware\SetPartnerToRequest;
use App\Http\Middleware\SetPartnerShopToResource;
use App\System\Http\Request;
use LaravelCommon\App\Http\Kernel as AppHttpKernel;

class Kernel extends AppHttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            //custom middleware
            // 'controller-after' => ControllerAfter::class
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // 'controller-return' => ControllerReturn::class,
        WarehouseHydrator::NAME => WarehouseHydrator::class,
        ShopHydrator::NAME => ShopHydrator::class,
        ProductCategoryHydrator::NAME => ProductCategoryHydrator::class,
        ProductHydrator::NAME => ProductHydrator::class,
        SetPartnerToRequest::NAME => SetPartnerToRequest::class,
        SetPartnerShopToResource::NAME => SetPartnerShopToResource::class,
        ResourceBelongsToPartner::NAME => ResourceBelongsToPartner::class

    ];

    /**
     * Handle an incoming HTTP request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle($request)
    {
        return parent::handleRequest(Request::class, $request);
    }
}
