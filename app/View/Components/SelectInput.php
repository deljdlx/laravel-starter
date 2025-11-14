<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public ?string $label;

    public string $name;

    public array $options;

    public string|array|null $selected;

    public ?string $placeholder;

    public bool $required;

    public bool $disabled;

    public bool $multiple;

    public ?string $description;

    public ?string $id;

    public bool $floating = false;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        array $options = [],
        string|array|null $selected = null,
        ?string $label = null,
        ?string $placeholder = null,
        bool $required = false,
        bool $disabled = false,
        bool $multiple = false,
        ?string $description = null,
        ?string $id = null,
        bool $floating = false,
    ) {
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->multiple = $multiple;
        $this->description = $description;
        $this->id = $id ?? $name;

        $this->floating = $floating;
    }

    /**
     * Check if an option is selected
     */
    public function isSelected(string $value): bool
    {
        $oldValue = old($this->name);

        if ($oldValue !== null) {
            if (is_array($oldValue)) {
                return in_array($value, $oldValue);
            }
            return (string) $oldValue === (string) $value;
        }

        if ($this->selected !== null) {
            if (is_array($this->selected)) {
                return in_array($value, $this->selected);
            }
            return (string) $this->selected === (string) $value;
        }

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}
