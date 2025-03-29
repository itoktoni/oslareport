<?php

namespace App\Providers;

use App\Dao\Models\Core\Filters;
use App\Dao\Models\Core\SystemGroup;
use App\Dao\Models\Core\SystemLink;
use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Core\SystemPermision;
use App\Dao\Models\Core\SystemRole;
use App\Dao\Models\Core\Team;
use App\Dao\Models\Core\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserModel', User::class);
        $this->app->bind('MenuModel', SystemMenu::class);
        $this->app->bind('LinkModel', SystemLink::class);
        $this->app->bind('RoleModel', SystemRole::class);
        $this->app->bind('GroupModel', SystemGroup::class);
        $this->app->bind('PermisionModel', SystemPermision::class);
        $this->app->bind('FilterModel', Filters::class);
        $this->app->bind('TeamModel', Team::class);
    }

    public function getCacheFile()
    {

        $path = app_path('Facades/Model');
        $fileNames = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            if (! in_array($file->getFilenameWithoutExtension(), ['FilterModel', 'GroupModel', 'LinkModel', 'MenuModel', 'PermisionModel', 'RoleModel', 'TeamModel', 'UserModel'])) {
                $code = $file->getFilenameWithoutExtension();
                $mod = str_replace('Model', '', $code);
                $fileNames[$code] = "\\App\\Dao\\Models\\{$mod}";
            }
        }

        return $fileNames;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Cache::forget('facades');
        if (Cache::has('facades')) {
            $facades = Cache::get('facades');
        } else {
            $facades = $this->getCacheFile();
            Cache::put('facades', $facades);
        }

        foreach (Cache::get('facades') as $key => $value) {

            $this->app->bind($key, function () use ($value) {
                return new $value;
            });
        }
    }
}
