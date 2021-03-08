<?php

namespace App\Http\Controllers;

use App\Models\PaketType;
use Illuminate\Http\Request;

class PaketTypeController extends Controller
{


  public function typePaketTypes(){
    $types=PaketType::all();
    return $types;
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
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function show(PaketType $paketType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaketType $paketType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaketType $paketType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketType $paketType)
    {
        //
    }
}
