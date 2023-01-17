<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index(){
        $pagination =5; 
        $data = Balance::latest()->paginate(5);

        return view ('balance.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }
   
    public function view($id){
        $data = Balance::where('id', $id)->get();

        return view ('balance.view',
        compact('data'));
    }

    public function insert(Request $request){

        $data=([
            "label_sorting"=>$request->label_sorting,
            "label_balance"=>$request->label_balance
        ]);

        Balance::where("part_number",$request->part_number)
        ->update($data);
    }
}
