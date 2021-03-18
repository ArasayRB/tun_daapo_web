<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\ServiceTrait;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, ServiceTrait;
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

    public function addTranslateService(Request $request){
      $data=request()->validate([
        'name'=> 'required|max:255',
        'lang'=> 'required',
        'description'=> 'required',
      ]);

      $service=Service::find(request('service_id'));
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'name',
        'content_trans'=>request('name')],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $this->storeTranslate($data_trans);
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

    public function updateTranslatedServByLang($service_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'name'=> 'required|max:255',
        'description'=> 'required',
      ]);

      $service=Service::find($service_id);
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);


      $data_trans=array(
        ['id_content_trans'=>$service_id,
        'content'=>request('name'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>request('name')],
        ['id_content_trans'=>$service_id,
        'content'=>request('description'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $result=$this->updateTranslate($data_trans);
      return $result;
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
        $contentType='Service';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($service->id,$tipo_content);
      $servicio->delete();
    }
}
