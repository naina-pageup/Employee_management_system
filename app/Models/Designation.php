<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'department_id',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
     }
}
