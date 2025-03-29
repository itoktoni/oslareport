<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

class FormRange extends Component
{
    use HandlesDefaultAndOldValue;
    use HandlesValidationErrors;

    public string $name;

    public string $label;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $label = '',
        $bind = null,
        $default = null,
        $language = null,
        bool $showErrors = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->showErrors = $showErrors;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->setValue($name, $bind, $default, $language);
    }
}
