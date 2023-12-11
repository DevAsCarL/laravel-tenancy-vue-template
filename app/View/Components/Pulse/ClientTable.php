<?php

namespace App\View\Components\Pulse;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientTable extends Component
{
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct( public string $cols, public string $rows = '1')
    {
        $this->class = "default:row-span-{$rows} default:lg:col-span-{$cols}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pulse.client-table');
    }
}
