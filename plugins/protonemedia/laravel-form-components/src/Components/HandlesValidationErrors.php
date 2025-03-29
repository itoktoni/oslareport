<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

trait HandlesValidationErrors
{
    public $showErrors = true;

    /**
     * Returns a boolean wether the given attribute has an error
     * and the should be shown.
     */
    public function hasErrorAndShow(string $name, string $bag = 'default'): bool
    {
        return $this->showErrors
            ? $this->hasError($name, $bag)
            : false;
    }

    /**
     * Getter for the ErrorBag.
     */
    protected function getErrorBag(string $bag = 'default'): MessageBag
    {
        $bags = View::shared('errors', fn () => request()->session()->get('errors', new ViewErrorBag));

        return $bags->getBag($bag);
    }

    /**
     * Returns a boolean wether the given attribute has an error.
     */
    public function hasError(string $name, string $bag = 'default'): bool
    {
        $name = str_replace(['[', ']'], ['.', ''], Str::before($name, '[]'));

        $errorBag = $this->getErrorBag($bag);

        return $errorBag->has($name) || $errorBag->has($name.'.*');
    }
}
