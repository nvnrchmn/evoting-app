<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $name;
    public string $id;
    public $options;
    public ?string $selected;

    public function __construct(string $name, string $id = null, $options = [], string $selected = null)
    {
        $this->name     = $name;
        $this->id       = $id ?? $name;
        $this->options  = $options;
        $this->selected = $selected;
    }

    public function render(): View | Closure | string
    {
        return view('components.form.select');
    }
}
