<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class Pagination extends Component
{
    use WithPagination;
    // public $Employee;
    public $search;
    public $sal_from;
    public $sal_to;
    public $joining_date_from;
    public $joining_date_to;
    public $manager_id;

    public function render()
    {

            $Employee = Employee::where(function ($query) {
            $query->where('is_active', 1);
            if (!empty ($this->search)) {
                $query->where('name', 'like', '%' . $this->search . '%');
            }
            if (!empty ($this->sal_from)) {
                $query->where('salary', '>=', $this->sal_from);
            }
            if (!empty ($this->sal_to)) {
                $query->where('salary', '<=', $this->sal_to);
            }
            if (!empty ($this->joining_date_from)) {
                $query->where('joining_date', '>=', $this->joining_date_from);
            }
            if (!empty ($this->joining_date_to)) {
                $query->where('joining_date', '<=', $this->joining_date_to);
            }
            if (!empty ($this->manager_id)) {
                $query->where('manager_id', '=', $this->manager_id);
            }


        })
            ->paginate(3);
        return view('livewire.pagination', ['Employee' => $Employee,
         'Mangers' => DB::table('Employees AS e')
                      ->join('Employees AS m','e.manager_id','=','m.id')
                      ->select('m.id','m.name')
                      ->distinct()
                      ->get()
    ]);

    }

}
