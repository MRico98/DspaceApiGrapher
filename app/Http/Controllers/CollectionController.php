<?php

namespace App\Http\Controllers;

use App\Services\ICollectionService;
use Laravel\Lumen\Routing\Controller as BaseController;

class CollectionController extends BaseController
{
    private $collectionService;

    public function __construct(ICollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function getCollections()
    {
        $jsonResponde = $this->collectionService->getAllColections();
        
        return response($jsonResponde)->header('Content-Type', "application/json");
    }

}