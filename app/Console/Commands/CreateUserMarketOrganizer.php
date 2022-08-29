<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Repositories\ScopeRepository;
use LaravelCommon\App\Repositories\User\ScopeMappingRepository;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelOrm\Exception\EntityException;
use LaravelOrm\Exception\ValidationException;

class CreateUserMarketOrganizer extends Command
{

    public const MARKET_ORGANIZER_SCOPE_NAME = 'marketOrganizer';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:create-user-market-organizer  
        {username : Username}
        {email : Email}
        {password : Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user market organizer';


    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * Undocumented variable
     *
     * @var ScopeMappingRepository
     */
    protected ScopeMappingRepository $scopeMappingRepository;

    /**
     * Undocumented variable
     *
     * @var ScopeRepository
     */
    protected ScopeRepository $scopeRepository;

    /**
     * Undocumented variable
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Create a new command instance.
     *
     * @param UserRepository $userRepository
     * @param ScopeMappingRepository $scopeMappingRepository
     * @param ScopeRepository $scopeMappingRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        UserRepository $userRepository,
        ScopeMappingRepository $scopeMappingRepository,
        ScopeRepository $scopeRepository,
        EntityUnit $entityUnit

    )
    {
        $this->userRepository = $userRepository;
        $this->scopeMappingRepository = $scopeMappingRepository;
        $this->scopeRepository = $scopeRepository;
        $this->entityUnit = $entityUnit;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->argument('username');
        $email = $this->argument('email');
        $password = $this->argument('password');

        try {
            $user = $this->userRepository->newEntity();

            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $this->entityUnit->preparePersistence($user);
            $user->setPassword(Hash::make($password));

            $scope = $this->scopeRepository->findOneOrFail([
                'where' => [
                    ['name', '=', self::MARKET_ORGANIZER_SCOPE_NAME]
                ]
            ]); 

            $userScopeMapping = $this->scopeMappingRepository->newEntity();
            $userScopeMapping->setUser($user);
            $userScopeMapping->setScope($scope);
            $this->entityUnit->preparePersistence($userScopeMapping);
            
            $this->entityUnit->flush();

            $this->info('Username ' . $username . ' created');
        } catch (Exception $e) {
            $this->info('Failed to create user : ' . $e->getMessage());
        } catch (ValidationException $e) {
            $this->info('Failed to create user : ' . $e->getMessage());
        } 

        return 0;
    }
}
