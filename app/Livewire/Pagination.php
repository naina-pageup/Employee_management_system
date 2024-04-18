<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
class Pagination extends Component
{
    use WithPagination;
    
    public function render()
    {
        //return view('livewire.pagination');
        return view('livewire.pagination',['Employee' => Employee::paginate(5),'Mangers' =>Employee::all()->where('is_active',1)]);
    }
}
