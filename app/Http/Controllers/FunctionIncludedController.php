<?php

namespace App\Http\Controllers;

use App\Models\FunctionIncluded;
use Illuminate\Http\Request;

class FunctionIncludedController extends Controller
{

  public function availableFunctions(){
    $functions=FunctionIncluded::all();
    $available=[];
    foreach ($functions as $function) {
     $available[]=array('key'=>$function->id,'value'=>$function->name);
    }
    return $available;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function show(FunctionIncluded $functionIncluded)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function edit(FunctionIncluded $functionIncluded)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FunctionIncluded $functionIncluded)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunctionIncluded $functionIncluded)
    {
        //
    }
}
