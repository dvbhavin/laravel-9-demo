<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   
    protected $table = "student";

    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::boot();        
    }

    protected $fillable = [
        'name', 'email','school','class','total_score','address','phone_no'
    ];
}