<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputRadios extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?string $selected = "yes", public string $name, public ?string $id = "", public ?string $label = "", public ?string $paragraphe = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-radios');
    }
}
