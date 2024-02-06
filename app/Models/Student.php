<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table="students";
    protected $fillable=[
        'first_name',
        'last_name',
        'image'
    ];

    public function students(){
        return $this->belongsToMany(Course::class,"courses_students");
    }
}
