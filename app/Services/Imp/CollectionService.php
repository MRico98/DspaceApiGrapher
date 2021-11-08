<?php


namespace App\Services\Imp;

use App\Services\ICollectionService;
use App\Models\Collection;

class CollectionService implements ICollectionService
{
    public function getAllColections()
    {
        $collectionStringFile = file_get_contents(__DIR__ . "/../../../storage/JsonFiles/collections.json");
        $objectsArray = Collection::Deserialize($collectionStringFile);
        return $collectionStringFile;
    }
}