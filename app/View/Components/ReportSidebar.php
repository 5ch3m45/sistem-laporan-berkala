<?php

namespace App\View\Components;

use App\Models\Report;
use Illuminate\View\Component;

class ReportSidebar extends Component
{
    public $report;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $report = $this->report;
        return view('components.report-sidebar', compact('report'));
    }
}
