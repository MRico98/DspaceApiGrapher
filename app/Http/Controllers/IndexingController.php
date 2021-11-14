<?php

namespace App\Http\Controllers;

use App\Services\IIndexingService;
use Laravel\Lumen\Routing\Controller as BaseController;

class IndexingController extends BaseController
{
    private $indexingService;

    public function __construct(IIndexingService $indexingService)
    {
        $this->indexingService = $indexingService;
    }

    public function setDspaceInformation()
    {
        $this->indexingService->setJsonDocuments();
        //return response(201);
    }

}