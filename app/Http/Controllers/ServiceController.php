<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\ServiceTrait;
use App\Traits\ImageTrait;
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


  protected function validatorUpd(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string'],
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
      if(request('img')!=''&&request('img')!=null){

        $newFileName=$this->manageImageFile(request('img'),'service');
        $service->img=$newFileName;
      }

      $service->img_descript=request('img_descript');
      $service->name=request('name');
      $service->description=request('description');
      if(request('price')!='null'){
        $service->price=request('price');
    }
      $service->save();
      return $service;
    }

    public function addTranslateService(string $locale,Request $request){
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
    public function update(string $locale,Request $request, Service $service)
    {
      $servicio=Service::findOrFail($service->id);
      $newFileName;
      if (request('img')!=""){
        $this->validator($request->all())->validate();
        $newFileName=$this->manageImageFile(request('img'),'service');

        if($servicio->img!=null && $servicio->img!=''){
        $this->delImageFile($servicio->img,'service');
      }
          $servicio->img=$newFileName;
      }
      else{
        $this->validatorUpd($request->all())->validate();
      }
      $service->img_descript=request('img_descript');
      $servicio->name=request('name');
      $servicio->description=request('description');
      if(request('price')!='null'){
      $servicio->price=request('price');
    }
      $servicio->update();
      return $servicio;
    }

    public function updateTranslatedServByLang(string $locale,$service_id,$lang_name, Request $request){
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
    public function destroy(string $locale,Service $service)
    {
      $servicio=Service::findOrFail($service->id);
        $contentType='Service';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($service->id,$tipo_content);
        if($service->img!='' || $service->img!=null){
        $this->delImageFile($service->img,'service');
      }
      $servicio->delete();
    }
}
