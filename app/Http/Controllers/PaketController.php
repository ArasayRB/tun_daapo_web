<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Traits\ServiceTrait;
use App\Traits\PaketTrait;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\FunctionIncludedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
  use ServiceTrait, PaketTrait, FunctionIncludedTrait, ContentTypeTrait, TranslateTrait, LanguageTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllPakets(Request $request){
    $filter=$request->searcher;
    $pakets=Paket::filterByAttribute($filter)
                    ->get();
    $pakets_searched=[];
    foreach($pakets as $paket){
      $findText=stristr($paket->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $paket->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $paket->substr=$small_word;
        $paket->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$paket->name);
        $pakets_searched[]=$paket;
      }
    }
    return $pakets_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'name_button' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string'],
          'price' => ['required'],
          'type_id' => ['required'],
      ]);
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
      $functions;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }

      if(strpos(request('functions_included'), ',')){
        $functions = explode(",", request('functions_included'));
      }
      else{
        $functions=request('functions_included');
      }
      $pakets=new Paket();
      $pakets->name=request('name');
      $pakets->name_button=request('name_button');
      $pakets->description=request('description');
      $pakets->price=request('price');
      $pakets->type_id=request('type_id');
      $pakets->save();
      if(is_array($services)){
        foreach($services as $servic){
          $existService=$this->getServiceIf($servic);

          $pakets->services()->attach($existService->id,array('status'=>true));
        }
      }
      else{
        $existService=$this->getServiceIf($services);
        $pakets->services()->attach($existService->id,array('status'=>true));
      }

      if(is_array($functions)){
        foreach($functions as $funct){
          $existFunction=$this->getFunctionIncludedIf($funct);

          $pakets->functions()->attach($existFunction->id);
        }
      }
      else{
        $existFunction=$this->getFunctionIncludedIf($functions);
        $pakets->functions()->attach($existFunction->id);
      }
      $pakToAdd=$this->getPaket($pakets->id);
      return $pakToAdd;
    }

    public function addTranslate(Request $request){
      $data=request()->validate([
        'name'=> 'required|max:255',
        'lang'=> 'required',
        'description'=> 'required',
        'name_button'=> 'required',
      ]);

      $packet=Paket::find(request('paket_id'));
      $contentType='Paket';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$packet->id,
        'content'=>$packet['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'name',
        'content_trans'=>request('name')],
        ['id_content_trans'=>$packet->id,
        'content'=>$packet['name_button'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'name_button',
        'content_trans'=>request('name_button')],
        ['id_content_trans'=>$packet->id,
        'content'=>$packet['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $this->storeTranslate($data_trans);
      return $packet;
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
      $functions;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }

      if(strpos(request('functions_included'), ',')){
        $functions = explode(",", request('functions_included'));
      }
      else{
        $functions=request('functions_included');
      }
      $pakets->name=request('name');
      $pakets->name_button=request('name_button');
      $pakets->description=request('description');
      $pakets->price=request('price');
      $pakets->type_id=request('type_id');
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
        $pakets->services()->attach($existService->id,array('status'=>true));
      }


      $pakets->functions()->detach();

      if(is_array($functions)){
        foreach($functions as $funct){
          $existFunction=$this->getFunctionIncludedIf($funct);


          $pakets->functions()->attach($existFunction->id);
        }
      }
      else{
        $existFunction=$this->getFunctionIncludedIf($functions);
        $pakets->functions()->attach($existFunction->id);
      }
      $paketToAdd=$this->getPaket($pakets->id);
      return $paketToAdd;
    }

    public function updateTranslatedPacketByLang($packet_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'name'=> 'required|max:255',
        'name_button'=> 'required',
        'description'=> 'required',
      ]);

      $packet=Paket::find($packet_id);
      $contentType='Paket';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);


      $data_trans=array(
        ['id_content_trans'=>$packet_id,
        'content'=>request('name'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>request('name')],
        ['id_content_trans'=>$packet_id,
        'content'=>request('name_button'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name_button',
        'content_trans'=>request('name_button')],
        ['id_content_trans'=>$packet_id,
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
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
      $pakete=Paket::findOrFail($paket->id);
        $contentType='Paket';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($paket->id,$tipo_content);
      $pakete->delete();
      $pakete->services()->detach();
    }
}
