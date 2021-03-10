<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllServices(Request $request){
    $filter=$request->searcher;
    $services=Service::filterByAttribute($filter)
                    ->get();
    $services_searched=[];
    foreach($services as $service){
      $findText=stristr($service->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $service->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $service->substr=$small_word;
        $service->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$service->name);
        $services_searched[]=$service;
      }
    }
    return $services_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string'],
      ]);
  }

  public function getServiceList(){
    $services=Service::all();
    return $services;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page_resources.service.index');
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
      $service=new Service();
      $service->name=request('name');
      $service->description=request('description');
      $service->price=request('price');
      $service->save();
      return $service;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
      $this->validator($request->all())->validate();
      $servicio=Service::findOrFail($service->id);
      $servicio->name=request('name');
      $servicio->description=request('description');
      $servicio->price=request('price');
      $servicio->update();
      return $servicio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
      $servicio=Service::findOrFail($service->id);
      $servicio->delete();
    }
}
