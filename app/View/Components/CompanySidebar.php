<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employe;
use App\Models\File;
use App\Models\Note;
use App\Models\Report;
use Illuminate\View\Component;

class CompanySidebar extends Component
{
    public $company, $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Company $company, $active = null)
    {
      $this->active = $active;
      $this->company = $company;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $company = $this->company;
        $active = $this->active;
        $file_count = File::where('company_id', $this->company->id)->count();
        $note_count = Note::where('company_id', $this->company->id)->count();
        $employe_count = Employe::where('company_id', $this->company->id)->count();
        $report_count = Report::where('company_id', $this->company->id)->count();
        return view('components.company-sidebar', compact('company', 'active', 'file_count', 'note_count', 'employe_count', 'report_count'));
    }
}
