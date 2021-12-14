<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Options extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    // public $selected;
    public $options;
    public $name;

    public function __construct($options = null)
    {
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.options');
    }

    public function isSelected($option) {
        return $option === $this->selected;
    }
}
