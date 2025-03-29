<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

class FormTextarea extends Component
{
    use HandlesDefaultAndOldValue;
    use HandlesValidationErrors;

    public string $name;

    public $placeholder;

    public $col;

    public $toggle;

    public $button;

    public $prepend;

    public $append;

    public $icon;

    public $label;

    public string $rows;

    public bool $floating;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        $placeholder = null,
        $button = null,
        $icon = null,
        $toggle = null,
        $label = '',
        string $rows = 'text',
        $bind = null,
        $default = null,
        $col = null,
        $prepend = null,
        $append = null,
        $language = null,
        bool $showErrors = true,
        bool $floating = false
    ) {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->rows = $rows;
        $this->toggle = $toggle;
        $this->button = $button;
        $this->prepend = $prepend;
        $this->append = $append;
        $this->icon = $icon;
        $this->col = $col;
        $this->showErrors = $showErrors;
        $this->floating = $floating;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->col = $this->col ? 'col-md-'.$this->col : 'col';
        $this->rows = $this->rows ? '3' : '';

        if (! is_bool($this->label)) {
            $this->label = $this->label ? $this->label : formatLabel($name);
        }
        $this->setValue($name, $bind, $default, $language);
    }
}
