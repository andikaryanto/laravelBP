<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;
use App\Repositories\User\ShopMappingRepository;
use App\ViewModels\ShopViewModel;
use App\ViewModels\User\ShopMappingViewModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\Exceptions\DbQueryException;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Exception\DatabaseException;
use LaravelOrm\Exception\ValidationException;

class ShopMappingController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * Undocumented variable
     *
     * @var ShopRepository
     */
    protected ShopRepository $shopRepository;

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

    public function __construct(
        UserRepository $userRepository,
        ShopRepository $shopRepository,
        ShopMappingRepository $shopMappingRepository,
        EntityUnit $entityUnit
    ) {
        $this->userRepository = $userRepository;
        $this->shopRepository = $shopRepository;
        $this->shopMappingRepository = $shopMappingRepository;
        $this->entityUnit = $entityUnit;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return ResourceCreatedResponse|BadRequestResponse
     */
    public function register(Request $request)
    {
        $shopId = $request->shop_id;
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;

        try {
            $user = $this->userRepository->newEntity();
            $shop = $this->shopRepository->findOrFail($shopId);

            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->validate();
            $user->setPassword(Hash::make($password));
            $this->entityUnit->preparePersistence($user);

            $userShopMapping = $this->shopMappingRepository->newEntity();
            $userShopMapping->setUser($user);
            $userShopMapping->setShop($shop);
            $userShopMapping->validate();
            // return new ResourceCreatedResponse('OK', ResponseConst::OK, new UserViewModel($userShopMapping->getUser()));
            $this->entityUnit->preparePersistence($userShopMapping);

            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new ShopMappingViewModel($userShopMapping));
        } catch (DatabaseException $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        } catch (DbQueryException $e) {
            // $e->g
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        } catch (ValidationException $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        }
    }

    public function get(Request $request)
    {
        try {
            $user = $request->getResource();
            return new SuccessResponse('OK', ResponseConst::OK, new UserViewModel($user));
        } catch (Exception $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        }
    }

    public function delete(Request $request)
    {

        try {
            $user = $request->getResource();
            if (!$user->getIsDeleted()) {
                $user->setIsDeleted(true);
                $user->setIsActive(false);
                $user->setDeletedAt(Carbon::now());
                $this->entityUnit->preparePersistence($user);
                $this->entityUnit->flush();
            }
            return new SuccessResponse('OK', ResponseConst::OK, new UserViewModel($user));
        } catch (Exception $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        }
    }
}
