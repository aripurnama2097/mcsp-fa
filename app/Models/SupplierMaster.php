<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierMaster extends Model
{
    protected $connection = 'sqlsvr2';
    protected $table = 'Supplier';
    
}