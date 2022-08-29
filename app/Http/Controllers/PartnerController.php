<?php

namespace App\Http\Controllers;

use App\Repositories\PartnerRepository;
use App\ViewModels\PartnerViewModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Entities\User\ScopeMapping;
use LaravelCommon\App\Repositories\ScopeRepository;
use LaravelCommon\App\Repositories\User\ScopeMappingRepository;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelOrm\Exception\ValidationException;

class PartnerController extends Controller
{

    public const PARTNER_SCOPE_NAME = 'partner';

    /**
     * Undocumented variable
     *
     * @var ScopeRepository
     */
    protected ScopeRepository $scopeRepository;

    /**
     * Undocumented variable
     *
     * @var ScopeMappingRepository
     */
    protected ScopeMappingRepository $scopeMappingRepository;

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
        ScopeRepository $scopeRepository,
        ScopeMappingRepository $scopeMappingRepository,
        UserRepository $userRepository,
        PartnerRepository $partnerRepository,
        EntityUnit $entityUnit
    ) {
        $this->scopeRepository = $scopeRepository;
        $this->scopeMappingRepository = $scopeMappingRepository;
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

            $scope = $this->scopeRepository->getScopeByName(self::PARTNER_SCOPE_NAME);

            $userScopeMapping = $this->scopeMappingRepository->newEntity();
            $userScopeMapping->setUser($user);
            $userScopeMapping->setScope($scope);
            $this->entityUnit->preparePersistence($userScopeMapping);
            
            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new PartnerViewModel($partner));
        } catch (Exception $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        } catch (ValidationException $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
        }
    }
}
