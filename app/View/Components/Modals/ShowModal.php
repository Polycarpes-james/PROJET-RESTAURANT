<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $panier, public string $type, public string $contentId, public string $contentSecondClass, public string $headerClass, public string $mainClass, public string $footerClass)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.show-modal');
    }
}
