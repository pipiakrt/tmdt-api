<?php namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class VnsServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $directories = array_map('basename', File::directories(base_path('app/Modules')));
        foreach ($directories as $moduleName) {
            $this->app->register("Modules\\{$moduleName}\ModuleServiceProvider");
            $this->loadViewsFrom(base_path("app/Modules/{$moduleName}/Views"), $moduleName);
        }
    }
}
