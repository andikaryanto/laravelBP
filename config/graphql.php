<?php

//map path Graphql

use App\GraphQLs\Resolvers\GroupuserResolver;
use App\GraphQLs\Resolvers\UserResolver;
use App\GraphQLs\Types\User as UserType;

return [
   'resolvers' => [
      UserResolver::class,
      GroupuserResolver::class
   ],
   'schema_path' => app_path('GraphQLs/Schemas'),
   'contexts' => [
      
   ]
];
