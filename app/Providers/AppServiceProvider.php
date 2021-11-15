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
        $request = app('request');

        // ALLOW OPTIONS METHOD
        if($request->getMethod() === 'OPTIONS')  {
            app()->options($request->path(), function () {
                return response('OK',200)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods','OPTIONS, GET, POST, PUT, DELETE')
                    ->header('Access-Control-Allow-Headers', 'Content-Type, Origin');                    
            });
        }

        $this->app->bind(ICollectionService::class, CollectionService::class);
        $this->app->bind(ICommunitiesService::class, CommunitiesService::class);
        $this->app->bind(IIndexingService::class, IndexingService::class);
    }
}
