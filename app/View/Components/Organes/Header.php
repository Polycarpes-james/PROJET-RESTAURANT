<?php

namespace App\View\Components\Organes;

use App\Services\PanierService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $route, public string $background)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organes.header', [
            'total' => PanierService::total()
        ]);
    }
}
