<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $role;

    public function mount($role)
    {
        $this->role = $role;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
