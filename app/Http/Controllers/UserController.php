<?php

namespace App\Http\Controllers;

use App\Repositories\PartnerRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelOrm\Exception\ValidationException;

class UserController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     *
     * @var PartnerRepository
     */
    protected PartnerRepository $partnerRepository;

    /**
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;


    public function __construct(
        UserRepository $userRepository,
        PartnerRepository $partnerRepository,
        EntityUnit $entityUnit
    ) {
        $this->userRepository = $userRepository;
        $this->partnerRepository = $partnerRepository;
        $this->entityUnit = $entityUnit;
    }

    /**
     * Rwgister new user and as a partner
     *
     * @param Request $request
     * @return ResourceCreatedResponse|BadRequestResponse
     */
    public function register(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        try {
            $user = $this->userRepository->newEntity();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);

            $this->entityUnit->preparePersistence($user);
            $user->setPassword(Hash::make($password));

            $partner = $this->partnerRepository->newEntity();
            $partner->setUser($user);
            $this->entityUnit->preparePersistence($partner);

            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new UserViewModel($user));
        } catch (Exception $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        } catch (ValidationException $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        }
    }
}
