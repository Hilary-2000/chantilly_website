<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditMenu extends Component
{
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct($active)
    {
        // initialize
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-menu');
    }
}
