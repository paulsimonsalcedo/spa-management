<?php

namespace App\View\Components\Pos\Appointments\UpcomingTab;

use Illuminate\View\Component;

class move extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pos.appointments.upcoming-tab.move');
    }
}
