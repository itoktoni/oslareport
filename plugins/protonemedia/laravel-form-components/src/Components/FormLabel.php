<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

class FormLabel extends Component
{
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null)
    {
        $this->label = $label;
    }
}
