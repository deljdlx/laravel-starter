<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioInput extends Component
{
    public ?string $label;

    public string $name;

    public string $value;

    public bool $checked;

    public bool $disabled;

    public bool $inline;

    public ?string $description;

    public ?string $id;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $value,
        ?string $label = null,
        bool $checked = false,
        bool $disabled = false,
        bool $inline = false,
        ?string $description = null,
        ?string $id = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->disabled = $disabled;
        $this->inline = $inline;
        $this->description = $description;
        $this->id = $id ?? ($name.'_'.$value);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-input');
    }
}
