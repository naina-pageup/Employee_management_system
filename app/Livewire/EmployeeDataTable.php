<?php

namespace App\Livewire;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class EmployeeDataTable extends PowerGridComponent
{
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Employee::query()->with('getManager')->with('Departmet')->with('Designation');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('name_lower', fn (Employee $model) => strtolower(e($model->name)))
            ->add('email')
            ->add('contact')
            ->add('address')
            ->add('salary')
            ->add('manager_id', function (Employee $Employee) {
                return $Employee->manager_id;
            })
            ->add('manager_name', function (Employee $Employee) {
                if($Employee->manager_id != 0){
                return $Employee->getManager->name;
                }else{
                    return '-';  
                }
            })
            ->add('department_id', function (Employee $Employee) {
                return $Employee->department_id;
            })
            ->add('department_name', function (Employee $Employee) {  
                return $Employee->Departmet->name;  
            })

            ->add('designation_id', function (Employee $Employee) {
                return $Employee->designation_id;
            })
            ->add('designation_name', function (Employee $Employee) {  
                return $Employee->Designation->name; 
            })
            ->add('Joining Date')
            ->add('created_at')
            ->add('created_at_formatted', fn (Employee $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Email', 'email')
            ->searchable()
            ->sortable(),

            Column::make('Contact', 'contact')
            ->searchable(),

            Column::make('Address', 'address')
            ->searchable(),

            Column::make('Salary', 'salary')
            ->searchable()
            ->sortable(),

            Column::add()
            ->title(__('Manager'))
            ->field('manager_name', 'getManager.name')
            ->sortable('getManager.name'),

            Column::add()
            ->title(__('Department'))
            ->field('department_name', 'Departmet.name')
            ->sortable('Departmet.name'),
            
            Column::add()
            ->title(__('Designation'))
            ->field('designation_name', 'Designation.name')
            ->sortable('Designation.name'),
            

            Column::make('Joining Date','joining_date'),

            Column::make('Created at', 'created_at')
                ->hidden(),


            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::inputText('salary'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        // $this->js('alert('.$rowId.')');
        $this->redirect('edit/'.encrypt($rowId), '_blank');
    }
    public function remove($rowId): void
    {
      
         $this->redirect('destroy/'.$rowId);
    }
    public function actions(Employee $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-whblackite py-2 px-4 border border-yellow-500 hover:border-black rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

                Button::add('remove')
                ->slot('remove')
                ->id()
                ->class('bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-whblackite py-2 px-4 border border-red-500 hover:border-black rounded')
                ->dispatch('remove', ['rowId' => $row->id])
              //  ->method('post'),
        ];
    }
    
    /*
    public function actionRules(Employee $row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
