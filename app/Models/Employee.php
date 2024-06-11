<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
    'employee_id',
    'name',
    'email',
    'contact',
    'address',
    'salary',
    'manager_id',
    'department_id',
    'designation_id',
    'joining_date',
    'is_active',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at',
    ];

    public function getManager()
    {

             return $this->belongsTo(Employee::class,'manager_id','id');
    }

    public function Departmet()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function Designation()
    {
        return $this->belongsTo(Designation::class,'designation_id');
    }

    public function getNameAttribute($value)
    {
        return ;
    }
}
