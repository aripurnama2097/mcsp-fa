<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitLabel extends Model
{
    use HasFactory;
    protected $table ="split_Label";
    protected $guarded =['id'];
}
