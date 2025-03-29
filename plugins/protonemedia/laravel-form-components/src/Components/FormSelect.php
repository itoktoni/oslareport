<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FormSelect extends Component
{
    use HandlesBoundValues;
    use HandlesValidationErrors;

    public string $name;

    public $label;

    public $options;

    public $api;

    public $col;

    public $prepend;

    public $append;

    public $selectedKey;

    public $search;

    public bool $multiple;

    public bool $floating;

    public string $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        $label = '',
        $options = [],
        $bind = null,
        $col = null,
        $api = '',
        $prepend = null,
        $append = null,
        $search = '',
        $default = null,
        bool $multiple = false,
        bool $showErrors = true,
        bool $manyRelation = false,
        bool $floating = false,
        string $placeholder = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->api = $api;
        $this->col = $col;
        $this->prepend = $prepend;
        $this->append = $append;
        $this->search = $search;
        $this->manyRelation = $manyRelation;
        $this->placeholder = $placeholder;

        if ($this->isNotWired()) {
            $inputName = static::convertBracketsToDots(Str::before($name, '[]'));

            if (is_null($default)) {
                $default = $this->getBoundValue($bind, $inputName);
            }

            $this->selectedKey = old($inputName, $default) ?? request()->get($inputName);

            if ($this->selectedKey instanceof Arrayable) {
                $this->selectedKey = $this->selectedKey->toArray();
            }
        }

        $this->multiple = $multiple;
        $this->showErrors = $showErrors;
        $this->floating = $floating && ! $multiple;

        $this->col = $this->col ? 'col-md-'.$this->col : 'col';

        if (! is_bool($this->label)) {
            $this->label = $this->label ? $this->label : formatLabel($name);
        }

        if (empty($placeholder)) {
            $this->placeholder = '- Silahkan pilih -';
        }
    }

    public function isSelected($key): bool
    {
        if ($this->isWired()) {
            return false;
        }

        return in_array($key, Arr::wrap($this->selectedKey));
    }

    public function nothingSelected(): bool
    {
        if ($this->isWired()) {
            return false;
        }

        return is_array($this->selectedKey) ? empty($this->selectedKey) : is_null($this->selectedKey);
    }
}
