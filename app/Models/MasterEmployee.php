<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEmployee extends Model
{
    use HasFactory;

    protected $connection = 'sqlsvr3';
    protected $table = '[sapayroll].[HCE_access]';
   
}