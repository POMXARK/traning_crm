<?php

namespace CRM\Core\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Webkul\Core\Console\Commands\Install;
use Webkul\Core\Console\Commands\Version;
use Webkul\Core\Core;
use Webkul\Core\Facades\Core as CoreFacade;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/Config/concord.php' => config_path('concord.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
