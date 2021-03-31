<?php namespace App\Traits;

use Illuminate\Support\Facades\Route;
use ReflectionClass;

trait ModuleServiceProviderTrait {

    public $modulePath;
    public $moduleNameSpace;
    public $moduleName;


    public function __construct()
    {
        try {
            $reflector = new ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {
        }
        $this->modulePath = dirname($reflector->getFileName());
        $this->moduleNameSpace = $reflector->getNamespaceName();
        $this->moduleName = strtolower(explode('\\', $this->moduleNameSpace)[1]);
    }

    private function registerRouteAdmin() {
        Route::middleware(['api', 'auth:api'])
            ->namespace($this->namespace('Controllers\Admin'))
            ->prefix("admin/{$this->moduleName}")
            ->group($this->path('routes/admin.php'));
    }

    private function registerRoute() {
        Route::middleware('api')
            ->namespace($this->namespace('Controllers'))
            ->prefix($this->moduleName)
            ->group($this->path('routes/api.php'));
    }

    private function registerHelper($file = 'helpers.php') {
        require_once ($this->path($file));
    }

    private function registerConfig($file = 'config.php', $key = null) {
        $this->mergeConfigFrom($this->path($file), empty($key)?$this->moduleName:$key);
    }

    private function registerView($path = 'Views', $key = null) {
        $this->loadViewsFrom($this->path($path), empty($key)?$this->moduleName:$key);
    }

    private function registerMigration($path = 'Migrations') {
        $this->loadMigrationsFrom( $this->path($path));
    }

    private function path($file) {
        $file = ltrim($file, '/');
        return "{$this->modulePath}/{$file}";
    }

    private function namespace($name) {
        $name = ltrim($name, '\\');
        return "{$this->moduleNameSpace}\\{$name}";
    }

}
