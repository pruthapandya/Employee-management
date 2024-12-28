<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'gender', 'department_id', 'profile_picture'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
