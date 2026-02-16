<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    private string $title = '';

    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.card', [
            'title' => $this->title,
        ]);
    }
}
