<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Traits\ServiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
  use ServiceTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'name_button' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string'],
          'price' => ['required'],
      ]);
  }

  public function getPaketList(){
    $pakets=Paket::with('services')
                 ->get();
    return $pakets;
  }

  public function getPaket($paket){
    $pakets=Paket::with('services')
                 ->where('id',$paket)
                 ->first();
    return $pakets;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page_resources.paket.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validator($request->all())->validate();
      $services;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }
      $pakets=new Paket();
      $pakets->name=request('name');
      $pakets->name_button=request('name_button');
      $pakets->description=request('description');
      $pakets->price=request('price');
      $pakets->save();
      if(is_array($services)){
        foreach($services as $servic){
          $existService=$this->getServiceIf($servic);

          $pakets->services()->attach($existService->id);
        }
      }
      else{
        $existService=$this->getServiceIf($services);
        $pakets->services()->attach($existService->id,array('status'=>true));
      }
      $pakToAdd=$this->getPaket($pakets->id);
      return $pakToAdd;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
      $this->validator($request->all())->validate();
      $pakets=Paket::findOrFail($paket->id);
      $services;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }
      $pakets->name=request('name');
      $pakets->name_button=request('name_button');
      $pakets->description=request('description');
      $pakets->price=request('price');
      $pakets->update();
      $pakets->services()->detach();
      if(is_array($services)){
        foreach($services as $servic){
          $existService=$this->getServiceIf($servic);

          $pakets->services()->attach($existService->id,array('status'=>true));
        }
      }
      else{
        $existService=$this->getServiceIf($services);
        $pakets->services()->attach($existService->id);
      }
      $paketToAdd=$this->getPaket($pakets->id);
      return $paketToAdd;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
      $pakete=Paket::findOrFail($paket->id);
      $pakete->delete();
      $pakete->services()->detach();
    }
}
