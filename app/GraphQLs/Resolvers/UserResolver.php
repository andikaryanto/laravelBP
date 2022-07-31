<?php

namespace App\GraphQLs\Resolvers;

use App\GraphQLs\Types\User as TypesUser;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Services\UserService;
use LaravelCommon\App\ViewModels\User\TokenViewModel;
use LaravelCommon\App\ViewModels\UserCollection;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelGraphQL\AbstractResolver;
use LaravelGraphQL\GraphQLException;

class UserResolver extends AbstractResolver
{

    /**
     *
     * @param UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    /**
     *
     * @param UserService $userService
     */
    protected UserService $userService;

    /**
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository,
        UserService $userService
    ) {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * Get all users
     * 
     * #query
     * #args
     * #type [User]
     * #desc Get all users data
     *
     */
    final public function users()
    {
        return (new UserCollection($this->userRepository->collect()));
    }

    /**
     * #query
     * #args Int id
     * #type User
     * #desc Get a user data by id
     * 
     */
    final public function user($id){
        $user = $this->userRepository->find($id);
        if(empty($user))
            return null;
        return (new UserViewModel($user));
    }


    /**
     * #mutation
     * #args String username, String password
     * #type Token
     * #desc Generate user token
     * 
     */
    final public function generateToken($username, $password){

        $userToken = $this->userService->generateToken($username, $password);
        if(is_null($userToken))
            throw new GraphQLException('Failed to generate token');

        return (new TokenViewModel($userToken));
    }
}
