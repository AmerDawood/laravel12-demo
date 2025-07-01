<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
     public $role;

    public function mount()
    {
        $this->role = Auth::user()->getRoleNames()->first(); // assuming single role
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
