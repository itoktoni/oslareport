<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

class Form extends Component
{
    /**
     * Request method.
     */
    public string $method;

    /**
     * Form method spoofing to support PUT, PATCH and DELETE actions.
     * https://laravel.com/docs/master/routing#form-method-spoofing
     */
    public bool $spoofMethod = false;

    public $action;

    public $spa;

    public $model;

    public $upload;

    public $javascript;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $method = 'POST',
        $action = null,
        $spa = true,
        $model = false,
        $upload = null,
        $javascript = false
    ) {
        $this->method = strtoupper($method);
        $this->action = $action;
        $this->spa = $spa;
        $this->model = $model;
        $this->upload = $upload;
        $this->javascript = $javascript;
        $this->spoofMethod = in_array($this->method, ['PUT', 'PATCH', 'DELETE']);
        if (! $this->action) {
            $this->action = $this->model ? moduleRoute('postUpdate', ['code' => $model->{$model->getKeyName()}]) : moduleRoute('postCreate');
        }
    }

    /**
     * Returns a boolean wether the error bag is not empty.
     *
     * @param  string  $bag
     */
    public function hasError($bag = 'default'): bool
    {
        $errors = View::shared('errors', fn () => request()->session()->get('errors', new ViewErrorBag));

        return $errors->getBag($bag)->isNotEmpty();
    }
}
