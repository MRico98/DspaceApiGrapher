<?php

namespace App\Services\Imp;

use App\Models\Collection;
use App\Models\Community;
use App\Services\IIndexingService;
use App\Util\HttpUtil;

class IndexingService implements IIndexingService
{
    private array $communities;
    private array $collections;

    public function __construct()
    {
        $this->communities = array();
        $this->collections = array();
    }

    public function setJsonDocuments()
    {
        $dspaceConfigurationString = file_get_contents(__DIR__ . "/../../../dspaceApiConfig.json");
        $dspaceConfiguration = json_decode($dspaceConfigurationString);
        $jsonCommunities = HttpUtil::get($dspaceConfiguration->Url,$dspaceConfiguration->CommunitiesEndpoint);
        $this->communities = Community::Deserialize($jsonCommunities);
        foreach($this->communities as $community)
        {
            $this->setCommunitiesOfCollections($community,$dspaceConfiguration->Url . $dspaceConfiguration->CommunitiesEndpoint . '/',$dspaceConfiguration->CollectionsEndpoint);
            sleep(1);
        }
        $this->loadJsonFile();
    }

    private function setCommunitiesOfCollections(Community $community, string $dspaceUrl,string $collectionsEndpoint)
    {
        $jsonCollections = HttpUtil::getById($dspaceUrl,$collectionsEndpoint,$community->id);
        $community->collections = Collection::Deserialize($jsonCollections);
        foreach($community->collections as $collection){
            $collection->communities = array();
            $cloneCommunity = clone $community;
            $cloneCollections = clone $collection;
            $this->setCollectionsWithCommunities($cloneCommunity,$cloneCollections);
        }
    }

    private function setCollectionsWithCommunities(Community $community, Collection $collection)
    {
        $community->collections = array();
        $collectionArray = $this->searchCollectionsByCollectionName($this->collections,$collection->name);
        if(!$collectionArray){
            $collection->communities = array();
            array_push($collection->communities,$community);
            array_push($this->collections,$collection);
        }
        else
        {
            $collectionArray->numberItems += $collection->numberItems;
            $community->countItems = $collection->numberItems;
            array_push($collectionArray->communities,$community);
        }
    }

    private function searchCollectionsByCollectionName(array $collectionsArray,string $collectionName){
        for($count = 0;$count < count($collectionsArray);$count++){
            if($collectionsArray[$count]->name == $collectionName){ 
                $object = &$collectionsArray[$count];
                return $object;
            }
        }
        return false;
    }

    private function loadJsonFile()
    {
        $collectionsFile = __DIR__ . "/../../../storage/JsonFiles/collections.json";
        $communitiesFile = __DIR__ . "/../../../storage/JsonFiles/communities.json";
        if(file_exists($collectionsFile)){
            unlink($collectionsFile);
        }
        if(file_exists($communitiesFile)){
            unlink($communitiesFile);
        }
        $collectionsFile = fopen($collectionsFile, "w");
        $jsonCollectionsArray = json_encode($this->collections);
        $communitiesFile = fopen($communitiesFile, "w");
        $jsonCommunitiesArray = json_encode($this->communities);
        fwrite($collectionsFile,$jsonCollectionsArray);
        fwrite($communitiesFile,$jsonCommunitiesArray);
    }
}