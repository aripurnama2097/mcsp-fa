<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPart extends Model
{
    use HasFactory;

    protected $connection = 'sqlsvr2';
    protected $table = 'StdPack';
    protected $fillable = ['partnumber'];
    // protected $table = 'PartMs';
    // protected $fillable = ['PART_NO'];
}
