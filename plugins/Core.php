<?php

namespace Plugins;

use Illuminate\Support\Str;

class Core
{
    public static function getControllerName($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $clean = Str::replaceLast('Controller', '', $controller);

        return Str::snake($clean);
    }

    public static function getMethod($class, $module = false)
    {
        $function = new \ReflectionClass($class);
        $methodNames = [];
        $unset = [
            '__construct',
            'getData',
            'beforeForm',
            'beforeCreate',
            'beforeUpdate',
            'parseAbilityAndArguments',
            'normalizeGuessedAbilityName',
            'resourceAbilityMap',
            'resourceMethodsWithoutModels',
            'dispatch',
            'getValidationFactory',
            'share',
            'get',
            'middleware',
            'getMiddleware',
            'callAction',
            '__call',
            'authorize',
            'authorizeForUser',
            'authorizeResource',
            'dispatchNow',
            'validateWith',
            'validate',
            'validateWithBag',
            'dispatchSync',
        ];
        foreach ($function->getMethods() as $method) {
            if (! in_array($method->getName(), $unset) && $method->getModifiers() == 1) {
                $function_name = str_replace('_', ' ', Str::snake($method->getName()));
                $name = ucfirst(str_replace('get ', '', $function_name));
                $name = ucfirst(str_replace('Post ', '', $name));

                $methodNames[] = [
                    'primary' => $method->getName(),
                    'name' => $name,
                    'module' => $module,
                    'action' => $module.'.'.$method->getName(),
                    'reset' => 1,
                    'show' => str_contains($method, 'Create') ? 1 : 0,
                ];
            }
        }

        return collect($methodNames);
    }
}
