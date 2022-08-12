<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use LaravelCommon\App\ViewModels\UserCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\System\Http\Request;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\SuccessResponse;

class JustTest extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *
     * @param GroupuserRepository $groupuserRepository
     */
    protected GroupuserRepository $groupuserRepository;

    /**
     *
     * @param UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    /**
     *
     * @param UserService $serService
     */
    protected UserService $userService;

    /**
     *
     * @param GroupuserRepository $groupuserRepository
     * @param UserRepository $userRepository
     * @param UserService $serService
     */
    public function __construct(
        GroupuserRepository $groupuserRepository,
        UserRepository $userRepository,
        UserService $serService
    ) {
        $this->groupuserRepository = $groupuserRepository;
        $this->userRepository = $userRepository;
        $this->userService = $serService;
    }

    public function test(
        Request $request
    ) {
        // $token = $request->getToken();
        $g = $this->groupuserRepository->find(1);
        $users = $g->getUsers(); 
        return (new SuccessResponse('ok', [], new UserCollection($users)));
    }
}
