<?php

namespace App\Http\Controllers;

use App\Repositories\ShopRepository;
use App\ViewModels\UserViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Http\Controllers\UserController as ControllersUserController;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelOrm\Entities\EntityUnit;
use LaravelOrm\Exception\DatabaseException;

class UserController extends ControllersUserController
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
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param UserRepository $userRepository
     * @param ShopRepository $shopRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        UserRepository $userRepository,
        ShopRepository $shopRepository,
        EntityUnit $entityUnit
    ) {
        $this->userRepository = $userRepository;
        $this->shopRepository = $shopRepository;
        $this->entityUnit = $entityUnit;
        parent::__construct($userRepository);
    }

    /**
     * 
     */
    public function register(Request $request)
    {
        $shopId = $request->shop_id;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;

        try{
            $shop = $this->shopRepository->find($shopId);
            $user = $this->userRepository->newEntity();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setShop($shop);
            $user->setPassword(Hash::make($password));
            $this->entityUnit->preparePersistence($user);
            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new UserViewModel($user));

        } catch (DatabaseException $e){
            return new BadRequestResponse('Shop not found', ResponseConst::INVALID_DATA);
        }
    }
}
