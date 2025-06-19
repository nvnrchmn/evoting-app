<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Label extends Component
{
    public string $for;
    public string|null $value;

    public function __construct(string $for, string $value = null)
    {
        $this->for   = $for;
        $this->value = $value;
    }

    public function render(): View | Closure | string
    {
        return view('components.form.label');
    }
}
