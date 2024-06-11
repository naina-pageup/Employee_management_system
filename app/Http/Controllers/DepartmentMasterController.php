<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Facades\Crypt;
use \Carbon\Carbon;

class DepartmentMasterController extends Controller
{

    public function index()
    {
        $deparments = Department::all()->where('is_active', 1);

        return view('department_master.view_department', compact('deparments'));
    }

    public function create()
    {
        return view('department_master.create_department');

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $existing_data = Department::where('name', $request->input('name'))->where('is_active', 1)->first();
        if ($existing_data) {


            return redirect('admin/department')->with('error', 'Name has already exist ');

        } else {
            Department::create([
                'name' => $request->name,
                'created_by' => auth()->id(),
                'updated_by' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ]);

            return redirect('admin/department');

        }
    }

    public function edit($id)
    {

        $deparments = Department::findOrFail(Crypt::decrypt($id));

        return view('department_master.edit_department', compact('deparments'));


    }

    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);
        $existing_data = Department::where('name', $request->input('name'))->where('id', '!=', (Crypt::decrypt($id)))->where('is_active', 1)->first();
        if ($existing_data) {


            return redirect('admin/department')->with('error', 'Name has already exist ');

        } else {
            Department::find(Crypt::decrypt($id))->update([
                'name' => $request['name'],
                'updated_by' => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect('admin/department');
        }
    }

    public function destroy($id)
    {
        $existing_data = Designation::all()->where('department_id', $id)->where('is_active', 1)->first();
        if ($existing_data) {
            return redirect('admin/department')->with('error', 'Can`t remove this department because it related to designations');

        } else {
            Department::find($id)->update([
                'is_active' => 0,
                'updated_by' => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect('admin/department');
        }
    }
}
