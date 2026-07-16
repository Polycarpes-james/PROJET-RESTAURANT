<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Ramsey\Collection\Collection;

class Smally extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Model $element, public string $delete, public string $class, public bool $linkBtn, public string $route, public ?bool $isViewlable = null, public string $kind)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.smally');
    }
}
