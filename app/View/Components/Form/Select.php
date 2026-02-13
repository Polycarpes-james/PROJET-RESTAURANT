<?php

namespace App\View\Components\Form;

use Closure;
use Hamcrest\Type\IsBoolean;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $label, public Collection $categories, public Collection $value, public ?string $multiple = "false", public ?string $paragraphe = null, public ?string $headCategories = null, public ?string $id = null)
    {
        //
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select');
    }
}
