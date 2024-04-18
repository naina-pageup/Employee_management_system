<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
Use \Carbon\Carbon;

class EmployeeMasterController extends Controller
{
    public function index()
    {
    //     $Employees = Employee::all()->where('is_active',1);
    //    return view('employee_master.view_employee',compact('Employees'));
          return view('employee_master.view_employee');

    }
   public function datatable()
   {
    return view('employee_master.view_employee_datatable');
   }

   public function pagination()
   {
    return view('employee_master.view_employee_pagination_table');
    
   }
    public function create()
    {
        $Deparments = Department::all()->where('is_active',1);
        $Mangers = Employee::all()->where('is_active',1);
        return view('employee_master.create_employee',compact('Deparments','Mangers'));
    }

    public function getDesignation($DepartmentId)
    {
        $designations = Designation::all()->where('department_id',$DepartmentId)->where('is_active',1);
        return response()->json($designations);
    }

    public function store(Request $request)
    {
        $request->validate([

           'name' => 'required|string',
           'email'=>'required|email',
           'salary'=>'required|not_in:0|numeric',
           'mobile'=>'required|min:11|numeric',
           'manager_id'=>'nullable',
           'Department'=>'required',
           'designation'=>'required',
           'joining_date'=>'required',
           'address'=>'required'

        ]);
        //Gentrate Employee Id 
        $Mangers = Employee::orderBy('id','desc')->get()->first();
       // dd($Mangers);
        $common = "EMP/";
        $find_join_month=date_create($request['joining_date']);
        $month =date_format($find_join_month,"/m/");
        $find_join_year = date_create($request['joining_date']);
        $year = (int)date_format($find_join_year,"y");
        $p_year = 0;
        if( $Mangers == null){
            $p_seq = 1;
            $employee_id =$common.$year.$month.$p_seq;
        }elseif($Mangers != NULL){
       // dd($p_seq);
        $p_seq =intval((substr( $Mangers->employee_id,10)));
        $p_year = (int)(substr( $Mangers->employee_id, 4,2));
        }
       
        //Find previous Record Year 
        if(($Mangers != NULL)  && ($p_seq >= 1) && ($year == $p_year)){
          $p_seq = $p_seq + 1;
          $p_seq = strval($p_seq);
          $employee_id =$common.$year.$month.$p_seq;
        }
       elseif($year != $p_year && $year){
            $p_seq = 1;
            $employee_id =$common.$year.$month.$p_seq;
        }
        $existingData = Employee::where('email', $request->input('email'))->where('is_active',1)->first();
        if($existingData){
            
            return redirect('admin/employee')->with('error','Email already exist');
        }else{
        Employee::create([
                'employee_id' => $employee_id, 
                'name' => $request->name, 
                'email' =>  $request->email, 
                'contact' =>  $request->mobile, 
                'address' =>  $request->address, 
                'salary' =>  $request->salary, 
                'manager_id' =>  $request->manager_id, 
                'department_id' =>  $request->Department, 
                'designation_id' =>  $request->designation, 
                'joining_date' =>  date("Y-m-d H:i:s",strtotime($request->joining_date)), 
                'created_by' => auth()->id(),
                'updated_by' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ]);
            return redirect('admin/employee');
        }
    }
    public function edit($id)
    {
        $Deparments = Department::all()->where('is_active',1);
        $Mangers = Employee::all()->where('is_active',1);
        $Employee =Employee::findOrFail(Crypt::decrypt($id));   
        return view('employee_master.edit_employee',compact('Deparments','Mangers','Employee'));
    }

    public function update($id,Request $request)
    {
        $request->validate([

            'name' => 'required|string',
            'email'=>'required|email',
            'salary'=>'required|not_in:0|numeric',
            'mobile'=>'required|min:11|numeric',
            'manager_id'=>'nullable',
            'Department'=>'required',
            'designation'=>'required',
            'joining_date'=>'required',
            'address'=>'required'
 
         ]);
         $existingData = Employee::where('email', $request->input('email'))->where('id','!=',($id))->where('is_active',1)->first();
         if($existingData){
            return redirect('admin/employee')->with('error','Email already exist');

         }else{
         Employee::find($id)->update([

                'name' => $request->name, 
                'email' =>  $request->email, 
                'contact' =>  $request->mobile, 
                'address' =>  $request->address, 
                'salary' =>  $request->salary, 
                'manager_id' =>  $request->manager_id, 
                'department_id' =>  $request->Department, 
                'designation_id' =>  $request->designation, 
                'joining_date' =>  date("Y-m-d H:i:s",strtotime($request->joining_date)), 
                'updated_by'=>auth()->id(),
                'updated_at' =>Carbon::now(),
         ]);
         return redirect('admin/employee');
        }
    }

    public function show($id)
    {
        $Employee =Employee::findOrFail(Crypt::decrypt($id));   
        return view('employee_master.show_employee',compact('Employee'));
    }

    public function destroy($id)
    {
        $existing_data = Employee::all()->where('manager_id',$id)->first();
       if($existing_data){
        return redirect('admin/employee')->with('error','This Employee is working as manager');
       }
       else{
        Employee::find($id)->update([
            'is_active' => 0,
            'updated_by'=>auth()->id(),
            'updated_at' =>Carbon::now(),
        ]);
        return redirect('admin/employee');
   }
    }
}
