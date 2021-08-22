<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanySidebar extends Component
{
    public $cid, $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cid = null, $active = null)
    {
      $this->active = $active;
      $this->cid = $cid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      return view('components.company-sidebar', ['cid' => $this->cid, 'active' => $this->active]);
    }
}
