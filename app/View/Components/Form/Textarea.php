<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public string $name;
    public string $id;
    public ?string $value;

    public function __construct(string $name, string $id = null, string $value = null)
    {
        $this->name  = $name;
        $this->id    = $id ?? $name;
        $this->value = $value;
    }

    public function render(): View | Closure | string
    {
        return view('components.form.textarea');
    }
}
