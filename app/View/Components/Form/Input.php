<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $type;
    public string $name;
    public string $id;
    public string $value;

    public function __construct(
        string $name,
        string $type = 'text',
        string $id = null,
        string $value = ''
    ) {
        $this->name  = $name;
        $this->type  = $type;
        $this->id    = $id ?? $name; // default id = name
        $this->value = $value;
    }

    public function render(): View | Closure | string
    {
        return view('components.form.input');
    }
}
