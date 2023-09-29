<?php

namespace App\Http\Livewire\Backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Livewire\Component;

class DashboardStatisticsComponent extends Component
{
    public $users = 0;

    public function mount()
    {
        $this->users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'user');
            }
        )->get();
     
    }

    public function render()
    {
        return view('livewire.backend.dashboard-statistics-component');
    }
}
