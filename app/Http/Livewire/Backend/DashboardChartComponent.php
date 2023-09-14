<?php

namespace App\Http\Livewire\Backend;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardChartComponent extends Component
{
    public $monthLabels = [];
    public $monthValues = [];

    public function mount()
    {
       ;
    }

    public function render()
    {
        return view('livewire.backend.dashboard-chart-component');
    }
}
