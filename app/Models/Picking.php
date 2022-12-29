<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
    use HasFactory;
    protected  $table ='register_part';
    protected $guarded  =['id'];


//    public function get_id_part($id)
//     { 
//         $this->db->where('id', $id);
//         return $this->db->get('register_part')->row();
//     }

}
