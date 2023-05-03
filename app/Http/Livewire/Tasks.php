<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tasks extends Component
{
    public function render()
    {
        $tasks = DB::table('tasks')->get();
        return view('livewire.tasks', ['tasks' => $tasks]);
    }
}
