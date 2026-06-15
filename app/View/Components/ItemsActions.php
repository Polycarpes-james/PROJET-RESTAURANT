<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemsActions extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $contentId, public ?Category $category = null, public string $contentSecondClass, public string $headerClass, public string $mainClass, public string $footerClass)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items-actions');
    }
}
