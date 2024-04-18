<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
class LiveSearchEmployee extends Component
{

    public $Employee;
    public $search;
    public $sal_from;
    public $sal_to;
    public $joining_date_from;
    public $joining_date_to;
    public $manager_id;
    //protected $quaryString = ['search'];
 
     public function mount()
     {
        $this->Employee = Employee::all()->where('is_active',1);
     }
     public function render()
     {
         return view('livewire.live-search-employee',['Mangers' =>Employee::all()->where('is_active',1)]);
     }
    public function updated()
    {
        $Employee = Employee::query();

        if(!empty($this->search))
        {
            $Employee = $Employee->where('name','like','%'.$this->search.'%')->where('is_active',1);
        }
        if(!empty($this->sal_from))
        {
            $Employee = $Employee->where('salary','>=',$this->sal_from)->where('is_active',1);
        }
        if(!empty($this->sal_to))
        {
            $Employee = $Employee->where('salary','<=',$this->sal_to)->where('is_active',1);
        }
        if(!empty($this->joining_date_from))
        {
            $Employee = $Employee->where('joining_date','>=',$this->joining_date_from)->where('is_active',1);
        }
        if(!empty($this->joining_date_to))
        {
            $Employee = $Employee->where('joining_date','<=',$this->joining_date_to)->where('is_active',1);
        }
        if(!empty($this->manager_id))
        {
            $Employee = $Employee->where('manager_id','=',$this->manager_id)->where('is_active',1);
        }
        $this->Employee = $Employee->get();
    }
   
}    

