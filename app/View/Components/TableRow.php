<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableRow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $items;

    public $fields;

    public function __construct($items, $fields)
    {
        $this->items = $items;
        $this->fields = $fields;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-row');
    }
}
