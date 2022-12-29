<?php

namespace App\Http\Controllers;

use App\Models\help;
use Illuminate\Http\Request;

class DashboardHelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.help.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->input->post('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(help $help)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\help  $help
     * @return \Illuminate\Http\Response
     */
    public function edit(help $help)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, help $help)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(help $help)
    {
        //
    }
}
