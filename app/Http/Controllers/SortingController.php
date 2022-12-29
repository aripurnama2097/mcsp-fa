<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sorting;

class SortingController extends Controller
{
    public function index()
    {      
        $pagination =5; 
        $data = Sorting::latest()->paginate(5);
        return view ('sorting.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }

    public function split($id){
        $data = Sorting::where('id', $id)->get();  
        
        return view ('sorting.split',
        compact('data'));
    }
}
