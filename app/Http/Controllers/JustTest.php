<?php

namespace App\Http\Controllers;

use App\Repositories\MgroupuserRepository;
use App\Repositories\MuserRepository;
use App\Services\UserService;
use App\ViewModels\Mgroupuser\MgroupuserViewModel;
use App\ViewModels\Muser\MuserCollection;
use App\ViewModels\Muser\MuserViewModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use LaravelCommon\Responses\SuccessResponse;

class JustTest extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *
     * @param MgroupuserRepository $mgroupuserRepository
     */
    protected MgroupuserRepository $mgroupuserRepository;

    /**
     *
     * @param MgroupuserRepository $mgroupuserRepository
     */
    protected MuserRepository $muserRepository;

    /**
     *
     * @param UserService $serService
     */
    protected UserService $userService;

    /**
     *
     * @param MgroupuserRepository $mgroupuserRepository
     * @param MuserRepository $muserRepository
     * @param UserService $serService
     */
    public function __construct(
        MgroupuserRepository $mgroupuserRepository,
        MuserRepository $muserRepository,
        UserService $serService
    ) {
        $this->mgroupuserRepository = $mgroupuserRepository;
        $this->muserRepository = $muserRepository;
        $this->userService = $serService;
    }

    public function test(
        Request $request
    ) {
        // $param = [
        //     'limit' => [
        //         'page' => 2,
        //         'size' => 5
        //     ]
        // ];
        $userEntity = $this->muserRepository->find(3);

        return (new SuccessResponse('Success', [], new MuserViewModel($userEntity)))->send();
    }
}
