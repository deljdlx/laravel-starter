<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public string $label;

    public string $name;

    public string $type;

    public ?string $placeholder;

    public ?string $value;

    public bool $required;

    public bool $disabled;

    public bool $readonly;

    public ?string $description;

    public ?string $id;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label,
        string $name,
        string $type = 'text',
        ?string $placeholder = null,
        ?string $value = null,
        bool $required = false,
        bool $disabled = false,
        bool $readonly = false,
        ?string $description = null,
        ?string $id = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->type = in_array($type, ['text', 'password', 'email', 'url', 'tel', 'number']) ? $type : 'text';
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->description = $description;
        $this->id = $id ?? $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
