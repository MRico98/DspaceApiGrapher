<?php

namespace App\Services\Imp;

use App\Services\ICommunitiesService;

class CommunitiesService implements ICommunitiesService
{
    public function getAllCommunities()
    {
        $collectionStringFile = file_get_contents(__DIR__ . "/../../../storage/JsonFiles/communities.json");
        return $collectionStringFile;
    }
}