<?php

namespace App\Providers;

use App\Http\Repository\Eloquent\Categeroies;
use App\Http\Repository\Eloquent\PostEloquent;
use App\Http\Repository\Interfaces\PostInterface;
use Illuminate\Support\ServiceProvider;

class BindInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostInterface::class,
            PostEloquent::class
        );
        $this->app->bind(Categeroies::class);

    }

}
