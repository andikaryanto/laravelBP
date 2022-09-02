<?php

namespace App\Http\Controllers;

use App\Repositories\Partner\ShopMappingRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\ShopRepository;
use App\ViewModels\ShopViewModel;
use Exception;
use Illuminate\Http\Request;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\ServerErrorResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Exception\ValidationException;

class ShopController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ShopRepository
     */
    protected ShopRepository $shopRepository;

    /**
     * Undocumented variable
     *
     * @var PartnerRepository
     */
    protected PartnerRepository $partnerRepository;

    /**
     * Undocumented variable
     *
     * @var ShopMappingRepository
     */
    protected ShopMappingRepository $shopMappingRepository;

    /**
     * Undocumented variable
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param ShopRepository $shopRepository
     * @param PartnerRepository $partnerRepository
     * @param ShopMappingRepository $shopMappingRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        ShopRepository $shopRepository,
        PartnerRepository $partnerRepository,
        ShopMappingRepository $shopMappingRepository,
        EntityUnit $entityUnit
    ) {
        $this->shopRepository = $shopRepository;
        $this->partnerRepository = $partnerRepository;
        $this->shopMappingRepository = $shopMappingRepository;
        $this->entityUnit = $entityUnit;
    }


    /**
     * Get all paged shop
     *
     * @return void
     */
    public function getAll()
    {

        $shops = $this->shopRepository->gather();
        if ($shops->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new SuccessResponse('OK', ResponseConst::OK, $shops));
    }

    public function get(Request $request)
    {
        $resource = $request->getResource();
        return new SuccessResponse('OK', ResponseConst::OK, new ShopViewModel($resource));
    }

    /**
     * Save new ware house, see entity-unit middleware, persistence happens there
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function store(Request $request)
    {
        try {
            $resource = $request->getResource();
            $user = $request->getUserToken()->getUser();

            $partner = $this->partnerRepository->getPartnerByUser($user);

            if (is_null($partner)) {
                return new BadRequestResponse('User is not a partner.', ResponseConst::INVALID_CREDENTIAL);
            }

            $partnerShop = $this->shopMappingRepository->newEntity();
            $partnerShop->setShop($resource);
            $partnerShop->setPartner($partner);

            $this->entityUnit->preparePersistence($resource);
            $this->entityUnit->preparePersistence($partnerShop);

            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new ShopViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }catch (ValidationException $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }

    /**
     * patch a column of entity
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function patch(Request $request)
    {
        try {
            $resource = $request->getResource();

            return new SuccessResponse('OK', ResponseConst::OK, new ShopViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }

    /**
     * patch a column of entity
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function delete(Request $request)
    {
        try {
            $resource = $request->getResource();

            return new SuccessResponse('OK', ResponseConst::OK, new ShopViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }
}
