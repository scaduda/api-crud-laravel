<?php

namespace App\Providers;

use App\Services\Contact\ContactService;
use App\Services\Contact\Interfaces\IContactService;
use App\Services\People\Interfaces\IPeopleService;
use App\Services\People\PeopleService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IPeopleService::class,
            PeopleService::class
        );

        $this->app->bind(
            IContactService::class,
            ContactService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Este método deixa de aninhar o conteúdo dos recursos
        // em uma chave 'data' em todo JsonResource
        JsonResource::withoutWrapping();
    }
}
