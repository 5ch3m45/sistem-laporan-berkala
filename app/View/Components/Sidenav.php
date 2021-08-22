<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidenav extends Component
{
    public $companyid, $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyid = null, $active = null)
    {
        $this->companyid = $companyid;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidenav', ['companyid' => $this->companyid, 'active' => $this->active]);
    }
}
