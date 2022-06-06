<?php
namespace App\Services;

use App\Entities\Muser;
use App\Repositories\MgroupuserRepository;
use App\Repositories\MuserRepository;

class UserService {

    /**
     * Undocumented variable
     *
     * @var MuserRepository
     */
    protected MuserRepository $muserRepository;

    /**
     *
     *
     * @param MuserRepository $muserRepository
     * @param MgroupuserRepository $mgroupuserRepository
     */
    public function __construct(
        MuserRepository $muserRepository,
        MgroupuserRepository $mgroupuserRepository
    )
    {
        $this->muserRepository = $muserRepository;
    }

    /**
     * generate user token
     *
     * @param string $username
     * @param string $password
     * @return Muser
     */
    public function generateToken(string $username, string $password){
        $param = [
            'where' => [
                ['Username', '=', 'test' ]
            ]
        ];
        return $this->muserRepository->findOne($param);
    }

}
