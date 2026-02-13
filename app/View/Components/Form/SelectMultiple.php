<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class SelectMultiple extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $label, public Collection $categories, public ?Collection $value = null, public ?string $multiple = "false", public ?string $paragraphe = null, public ?string $headCategories = null, public ?string $id = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-multiple');
    }
}
