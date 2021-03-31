<?php namespace Modules\OrderHistories;

use App\Traits\ModuleServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    use ModuleServiceProviderTrait;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRoute();
        //$this->registerRouteAdmin();
        $this->registerHelper();
    }
}
