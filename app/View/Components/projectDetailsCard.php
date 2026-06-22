<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class projectDetailsCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public int|float $number,
        public string $icon,
        public string $color = '#000'
    ) {

    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-details-card');
    }
}
