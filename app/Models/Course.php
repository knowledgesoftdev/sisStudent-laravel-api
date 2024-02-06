<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $table="courses";
    protected $fillable=array("*");

    public function students(){
        return $this->belongsToMany(Student::class,"courses_students");
    }
}
