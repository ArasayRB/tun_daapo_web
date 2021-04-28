<?php

namespace App\Http\Controllers;

use App\Models\PaketType;
use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use Illuminate\Support\Facades\Validator;

class PaketTypeController extends Controller
{
use ContentTypeTrait, TranslateTrait, LanguageTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllPaketType(Request $request){
    $filter=$request->searcher;
    $paket_types=PaketType::filterByAttribute($filter)
                    ->get();
    $paket_types_searched=[];
    foreach($paket_types as $paket_type){
      $findText=stristr($paket_type->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $paket_type->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $paket_type->substr=$small_word;
        $paket_type->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$paket_type->name);
        $paket_types_searched[]=$paket_type;
      }
    }
    return $paket_types_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
      ]);
  }


  public function typePaketTypes(){
    $types=PaketType::all();
    return $types;
  }

  public function getPacket($packet){
    return PaketType::find($packet);
  }

  public function getTranslatedPacketTypeByLang(string $locale,$lang,$packet_id,$content_type){
    $id_lang=$this->getLangIdByName($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $packet_translated=$this->getTranslatedTransItem($id_lang,$packet_id,$content_types[0]->id);
    $packet=$this->getPacket($packet_id);
    $packet->name=$packet_translated['name']['content_trans'];
    return $packet;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.page_resources.paket_type.index');
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
      $paket_types=new PaketType();
      $paket_types->name=request('name');
      $paket_types->save();
      return $paket_types;
    }

    public function addTranslatePackType(Request $request){
      $data=request()->validate([
        'name'=> 'required|max:255',
        'lang'=> 'required',
      ]);

      $paket_type=PaketType::find(request('packet_type_id'));
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'name',
        'content_trans'=>request('name')]
      );
      $this->storeTranslate($data_trans);
      return $paket_type;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, int $paketType)
    {
      $this->validator($request->all())->validate();
      $paket_types=PaketType::findOrFail($paketType);
      $paket_types->name=request('name');
      $paket_types->update();
      return $paket_types;
    }

    public function updateTranslatedPacketTypeByLang(string $locale,$paket_type_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'name'=> 'required|max:255',
      ]);

      $paket_type=PaketType::find($paket_type_id);
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);


      $data_trans=array(
        ['id_content_trans'=>$paket_type_id,
        'content'=>request('name'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>request('name')]
      );
      $result=$this->updateTranslate($data_trans);
      return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,int $paketType)
    {
      $paket_type=PaketType::findOrFail($paketType);
        $contentType='Paket Type';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($paketType,$tipo_content);
      $paket_type->delete();
      return $paket_type;
    }
}
