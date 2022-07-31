<?php

namespace App\GraphQLs\Resolvers;

use Exception;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\ViewModels\GroupuserCollection;
use LaravelCommon\App\ViewModels\GroupuserViewModel;
use LaravelGraphQL\AbstractResolver;
use LaravelGraphQL\GraphQLException;
use LaravelOrm\Entities\EntityManager;

class GroupuserResolver extends AbstractResolver
{

    /**
     * Undocumented function
     *
     * @param GroupuserRepository $groupuserRepository
     */
    protected GroupuserRepository $groupuserRepository;


    /**
     * Undocumented function
     *
     * @param EntityManager $entityManager
     */
    protected EntityManager $entityManager;


    /**
     *
     * @param UserRepository $groupuserRepository
     * @param EntityManager $entityManager
     */
    public function __construct(
        GroupuserRepository $groupuserRepository,
        EntityManager $entityManager
    ) {
        $this->groupuserRepository = $groupuserRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * #query
     * #desc Get all groupuser data
     * #args
     * #type [Groupuser]
     *
     */
    final public function groupusers()
    {
        $this->validateToken();
        return (new GroupuserCollection($this->groupuserRepository->collect()));
    }


    /**
     * #mutation
     * #args GroupuserInput groupuser
     * #type Groupuser
     * #desc Create new groupuser
     *
     */
    final public function createGroupuser($groupuserInput)
    {
        $groupuser = $this->groupuserRepository->newEntity();
        $groupuser->setGroupname($groupuserInput['groupname']);
        $groupuser->setDescription($groupuserInput['description']);
        $this->entityManager->persist($groupuser);
        return (new GroupuserViewModel($groupuser));
    }
}
