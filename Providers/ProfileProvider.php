<?php 
namespace Modular\Forms\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\App;

use Modular\Forms\Profile\Models\UserBasicInfoModel;
use Modular\Forms\Profile\Repositories\ProfileRepository;
use Modular\Repositories\ValidatorRepository;
use Modular\Forms\Authentication\Models\RegistrationModel;

/**
* Use Services Models
*/
/*
use Modular\Forms\Posts\Models\TextPostModel;
use Modular\Forms\Posts\Models\FilePostModel;
use Modular\Forms\Posts\Models\ListPostModel;
use Modular\Forms\Posts\Models\AskPostModel;
*/
/**
* Use Services
*/
/*
use Modular\Forms\Posts\Services\TextPostService;
use Modular\Forms\Posts\Services\FilePostService;
use Modular\Forms\Posts\Services\ListPostService;
use Modular\Forms\Posts\Services\AskPostService;
*/

class ProfileProvider extends ServiceProvider {

    public function boot() {
        include_once  __DIR__.'/../routes.php';
        $this->loadViewsFrom(__DIR__ . '/../Views', 'profile');
    }

    public function register() {
        $this->app->bind('Modular\Forms\Profile\Repositories\ProfileInterface', function ($app) {
            return new ProfileRepository(new RegistrationModel, new ValidatorRepository);
        });
    }

    /**
    * Register a view file namespace.
    *
    * @param  string  $namespace
    * @param  string  $path
    * @return void
    */
    protected function loadViewsFrom($path, $namespace)
    {
        if (is_dir($appPath = $this->app->basePath().'/resources/views/vendor/'.$namespace))
        {
            $this->app['view']->addNamespace($namespace, $appPath);
        }

        $this->app['view']->addNamespace($namespace, $path);
    }
}
