<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\RegisterPart;
use App\Models\MasterPart;
use App\Http\Requests\RegisterPartRequest;
use App\Models\Compare;


class RegisterPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $pagination =5; 
        
        $keyword= $request->keyword;
        $data2 = Compare::orderBy('id','desc')->get();
        $data = RegisterPart::where('rog_number', 'LIKE', '%'.$keyword.'%')
                ->orWhere('part_number', 'LIKE', '%'.$keyword.'%')
                ->orWhere('register_by', 'LIKE', '%'.$keyword.'%')
                ->paginate(5);
                // ->orderBy('id','asc');
                $data->withPath('register_part');
                $data->appends($request->all());
                // $data->orderBy('id','asc')->get();
        // $data2= $data->orderBy('id', 'asc')->get();
        return view ('register_part.index',compact(
            'data','data2'))->with('i', (request()->input('page', 1) -1) * $pagination);

    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     
     */
    public function create()
    {
       $model = new RegisterPart;
    //    $data_part = MasterPart::distinct('PART_NO')->pluck('PART_NO');
       $data_part = MasterPart::distinct('partnumber')
       ->whereRaw('year(input_date) > 2020')
       ->pluck('partnumber');
    //    return $data_part;
    //    $part=[$data_part['PART_NO']];
        // return $data_part;        
        return view('register_part.create', compact(
            'data_part'
        ));

       
    }

    public function createPart(Request $request)
    {

     RegisterPart ::create($request->all());
     MasterPart::distinct('partnumber')
       ->whereRaw('year(input_date) > 2020')
       ->pluck('partnumber');

        // return view('register_part.createPart', compact(
        //     'data_part'
        // ));


        return redirect('/register_part');
        // return view('/register_part', compact('data_part'));
        
  
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterPartRequest $request)
    {
       $model = new RegisterPart;
        
        $model->rog_number = $request->rog_number;
        $model->part_number = $request->part_number;
        $model->qty_request = $request->qty_request;
        $model->register_by = $request->register_by;
        $model->save();
        
        return redirect('/register_part')->with('success', 'Success! Data Berhasil Disimpan');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view ('register_part.index.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = RegisterPart::find($id);
        //    $data_part = MasterPart::distinct('PART_NO')->pluck('PART_NO');
           $data_part = MasterPart::distinct('partnumber')
           ->whereRaw('year(input_date) > 2020')
           ->pluck('partnumber');
        //    return $data_part;
        //    $part=[$data_part['PART_NO']];
            // return $data_part;        
            return view('register_part.edit', compact(
                'model'
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = RegisterPart::find($id);
        
        $model->rog_number = $request->rog_number;
        $model->part_number = $request->part_number;
        $model->qty_request = $request->qty_request;
        $model->register_by = $request->register_by;
        $model->save();
        
        return redirect('/register_part')->with('success', 'Success! Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        $model=RegisterPart::find($id);
        $model->delete();// METHOD DELETE
        return redirect('/register_part')->with('success', 'Success! Data Berhasil Dihapus');
    }


    public function confirm(Request $request){  

        
            $model = RegisterPart::find($request->id);

            $model->status = 'DONE';
            $model->save();

            // RegisterPart::where("status",$request->status)
            // ->where("id",$request->id)       
            // ->update(["status","DONE"]);
            
          
        return redirect('/register_part')->with('success', 'Success! Confirm Part');
        
         
        }     
        
        
    // public function picking(){

    //     return $this->hasOne(Compare::class,'foreign_key');
    // }
}


// $model = RegisterPart::find($id);