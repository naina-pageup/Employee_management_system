<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\Crypt;
Use \Carbon\Carbon;
class DesignationMasterController extends Controller
{
    public function index()
    {
        $designation = Designation::all()->where('is_active',1);
        return view('designation_master.view_designation',compact('designation'));
    }

    public function create()
    {
        $deparments = Department::all()->where('is_active',1);
        return view('designation_master.create_designation',compact('deparments'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'department' => 'required',

         ]);

        $existing_data = Designation::where('name', $request->input('name'))->where('is_active',1)->first();
        if($existing_data)
        {
          return redirect('admin/designation')->with('error', 'Name has already exist ');
            
        }else{
            Designation::create([
               
                'name' =>$request->name, 
                'department_id'=>$request->department,
                'created_by' => auth()->id(),
                'created_at' => Carbon::now(),
                'updated_at' => NULL,

            ]);

          return redirect('admin/designation');

        }
    }

    public function edit($id)
    {
        $Deparments = Department::all()->where('is_active',1);
        $Designation = Designation::findOrFail(Crypt::decrypt($id));
        return view('designation_master.edit_designation',compact('Deparments','Designation'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'department' => 'required',

         ]);

        $existing_data = Designation::where('name', $request->input('name'))->where('id','!=',(Crypt::decrypt($id)))->where('is_active',1)->first();
        if($existing_data)
        {
          return redirect('admin/designation')->with('error', 'Name has already exist ');
            
        }else{


            Designation::find(Crypt::decrypt($id))->update([
         
                'name' => $request['name'],
                'department_id' => $request['department'],
                'updated_by'=>auth()->id(),
                'updated_at' =>Carbon::now(),

            ]);

            return redirect('admin/designation');
        }  

    }
    public function destroy($id)
    {
        $existing_data = Employee::all()->where('designation_id',$id)->first();
        if($existing_data){
            return redirect('admin/designation')->with('error','This Designation Aloted To Employee');
        }else{
        Designation::find($id)->update([
            'is_active' => 0,
            'updated_by'=>auth()->id(),
            'updated_at' =>Carbon::now(),
         ]);

         return redirect('admin/designation');
        }
    }
}
