<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterPart extends Model
{
    use HasFactory;
   
    protected  $table ='register_part';
    protected $guarded  =['id'];

    // protected  $table_part = "select PART_NO  from PartMs";

    // public function picking()
    // {
    // return $this->hasOne(Compare::class);
    // }
}
