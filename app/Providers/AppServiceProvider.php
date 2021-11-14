<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ICollectionService;
use App\Services\ICommunitiesService;
use App\Services\IIndexingService;
use App\Services\Imp\CollectionService;
use App\Services\Imp\CommunitiesService;
use App\Services\Imp\IndexingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICollectionService::class, CollectionService::class);
        $this->app->bind(ICommunitiesService::class, CommunitiesService::class);
        $this->app->bind(IIndexingService::class, IndexingService::class);
    }
}
