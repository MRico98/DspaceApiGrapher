<?php

namespace App\Http\Controllers;

use App\Services\ICommunitiesService;
use Laravel\Lumen\Routing\Controller as BaseController;

class CommunitiesController extends BaseController
{
    private $communitiesService;

    public function __construct(ICommunitiesService $communitiesService)
    {
        $this->communitiesService = $communitiesService;
    }

    public function getCommunities()
    {
        $jsonResponde = $this->communitiesService->getAllCommunities();
        
        return response($jsonResponde)->header('Content-Type', "application/json");
    }

}