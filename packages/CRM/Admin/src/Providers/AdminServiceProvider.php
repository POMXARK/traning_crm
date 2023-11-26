<?php


namespace CRM\Admin\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;


class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'crm.admin');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'admin');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/CRM/admin/assets'),
        ], 'public');

//        Relation::morphMap([
//            'calls'         => 'CRM\Call\Models\Call',
//            'clients'       => 'CRM\Contact\Models\Client',
//        ]);

//        $this->publishes([
//            dirname(__DIR__) . '/Config/concord.php' => config_path('concord.php'),
//        ]);
    }

    public function register()
    {
        // $this->mergeConfigFrom(dirname(__DIR__) . '/Config/statistics_cards.php', 'statistics_cards');
    }
}
