<?php

namespace App\Http\Middleware;

use App\Dao\Models\Core\SystemPermision;
use Closure;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Support\Facades\Blade;
use Plugins\Alert;
use Plugins\Core;
use Plugins\Query;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private function getController($action)
    {
        $status = false;
        if (isset($action['controller'])) {
            $array_controller = explode('@', $action['controller']) ?? [];
            $action_controller = Core::getControllerName($array_controller[0]);
            $action_full_controller = $array_controller[0];

            return [$action_controller => $action_full_controller];
        }

        return $status;
    }

    private function checkAllowUrl()
    {
        $data = [
            'home',
            'profile',
        ];

        return ! (in_array(request()->segment(1), $data));
    }

    private function getGroup()
    {
        if ($this->checkAllowUrl()) {
            $group = Query::groups(true);
        } else {
            $group = Query::groups(auth()->user()->role);
        }

        if ($group->count() == 0 && $this->checkAllowUrl()) {
            Alert::error(ERROR_PERMISION);
            abort(402, ERROR_PERMISION);
        }

        return $group;
    }

    private function checkPermision($data_access, $access, $action_code)
    {
        if ($data_access) {
            Blade::if('can', function ($value) use ($access) {
                return ! (in_array(moduleAction($value), $access));
            });

            $check = $data_access
                ->where(SystemPermision::field_code(), $action_code);

            $check_role = $check->where(SystemPermision::field_role(), auth()->user()->role);

            if ($check_role->count() > 0) {
                Alert::error(ERROR_PERMISION);
                abort(402, ERROR_PERMISION);
            }

            $check_user = $check->where(SystemPermision::field_user(), auth()->user()->id);

            if ($check_user->count() > 0) {
                Alert::error(ERROR_PERMISION);
                abort(402, ERROR_PERMISION);
            }

            $check_level = $check->where(SystemPermision::field_level(), auth()->user()->level);

            if ($check_level->count() > 0) {
                Alert::error(ERROR_PERMISION);
                abort(402, ERROR_PERMISION);
            }

            $check_module = $check
                ->whereNull(SystemPermision::field_level())
                ->whereNull(SystemPermision::field_user())
                ->whereNull(SystemPermision::field_role());

            if ($check_module->count() > 0) {
                Alert::error(ERROR_PERMISION);
                abort(402, ERROR_PERMISION);
            }
        }
    }

    private function addNavigation($menu)
    {
        $nav = session()->get('navigation');
        $url = url()->current();
        $data = isset($menu['menu_action']) ? $menu : [
            'menu_code' => 'home',
            'menu_controller' => "App\Http\Controllers\Core\HomeController",
            'menu_action' => 'home',
            'menu_name' => 'Home',
            'menu_url' => 'home',
        ];

        $code = $data['menu_action'];

        if ($code) {
            if (empty($nav) || ! array_keys($nav, $code)) {
                $nav[$code] = array_merge($data, ['url' => $url]);
                session()->put('navigation', $nav);
            }
        }
    }

    public function handle($request, Closure $next)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $route = request()->route() ?? false;
        $action = $route->getAction();
        $action_code = $action['as'] ?? 'home';
        $action_controller = false;
        $action_full_controller = false;
        $action_route = $action['name'] ?? false;

        $menu = Query::getmenu($action_route) ?? [];
        $group = $this->getGroup();
        $permision = Query::permision();

        if ($array_controller = $this->getController($action)) {
            $action_controller = array_keys($array_controller)[0];
            $action_full_controller = array_values($array_controller)[0];

            $this->addNavigation($menu);
        }

        $data_access = $permision->where(SystemPermision::field_module(), $action_controller);
        $access = $data_access->pluck('system_permision_code')->toArray() ?? [];

        $this->checkPermision($data_access, $access, $action_code);

        try {

            $data = array_merge($menu, [
                'action_code' => $action_code,
                'module_code' => $action_controller,
                'template' => $action_controller, //legacy
                'route' => $action_route,
                'controller' => $action_full_controller,
                'groups' => $group,
                'environment' => env('APP_ENV', 'local'),
                'app_url' => url('/'),
                'timer' => env('APP_TIMER_ALERT', 5000),
            ]);

            SharedData::put($data);

        } catch (\Throwable $th) {
        }

        return $next($request);
    }
}
