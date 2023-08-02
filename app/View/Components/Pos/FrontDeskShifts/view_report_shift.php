<?php

namespace App\View\Components\Pos\FrontDeskShifts;

use Illuminate\View\Component;

class view_report_shift extends Component
{
    public $spaId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($spaId = null)
    {
        $this->spaId = $spaId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pos.front-desk-shifts.view_report_shift');
    }
}
