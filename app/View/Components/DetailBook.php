<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DetailBook extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.detail-book');
    }
}
