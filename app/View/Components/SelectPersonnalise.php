<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectPersonnalise extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public bool $filtable, public array $items, public bool $searchValide, public string $target)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-personnalise');
    }
}
