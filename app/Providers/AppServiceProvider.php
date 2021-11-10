<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ICollectionService;
use App\Services\ICommunitiesService;
use App\Services\Imp\CollectionService;
use App\Services\Imp\CommunitiesService;

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
    }
}
