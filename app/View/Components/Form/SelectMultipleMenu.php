<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class SelectMultipleMenu extends Component
{
    /**
     * Create a new component instance.
     */
     public function __construct(public Model $menu, public string $name, public string $label, public ?string $multiple = "false", public ?string $paragraphe = null, public ?string $headCategories = null, public ?string $id = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-multiple-menu');
    }
}
