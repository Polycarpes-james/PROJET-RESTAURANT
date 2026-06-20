<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Collection\Collection;

class ShowModalAdmin extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $contentId, public string $contentSecondClass, public string $headerClass, public string $mainClass, public string $footerClass)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-modal-admin');
    }
}
