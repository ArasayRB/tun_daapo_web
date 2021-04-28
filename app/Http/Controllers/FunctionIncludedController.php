<?php

namespace App\Http\Controllers;

use App\Models\FunctionIncluded;
use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\FunctionIncludedTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use Illuminate\Support\Facades\Validator;

class FunctionIncludedController extends Controller
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, FunctionIncludedTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllFunctionsIncluded(Request $request){
    $filter=$request->searcher;
    $functions_includeds=FunctionIncluded::filterByAttribute($filter)
                    ->get();
    $functions_includeds_searched=[];
    foreach($functions_includeds as $functions_included){
      $findText=stristr($functions_included->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $functions_included->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $functions_included->substr=$small_word;
        $functions_included->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$functions_included->name);
        $functions_includeds_searched[]=$functions_included;
      }
    }
    return $functions_includeds_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
      ]);
  }

  public function availableFunctions(){
    $functions=FunctionIncluded::all();
    $available=[];
    foreach ($functions as $function) {
     $available[]=array('key'=>$function->id,'value'=>$function->name);
    }
    return $available;
  }

  public function functionsIncludedList(){
    $functions=FunctionIncluded::all();
    return $functions;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.page_resources.function_included.index');
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
      $functions_included=new FunctionIncluded();
      $functions_included->name=request('name');
      $functions_included->description=request('description');
      $functions_included->save();
      return $functions_included;
    }

    public function addTranslateFunction(Request $request){
      $data=request()->validate([
        'name'=> 'required|max:255',
        'lang'=> 'required',
      ]);

      $function=FunctionIncluded::find(request('function_id'));
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));
      $data_trans=[];
       if(request('description')==''||request('description')==null){
         $data_trans=array(
           ['id_content_trans'=>$function->id,
           'content'=>$function['name'],
           'tipo_content'=>$tipo_content,
           'trans_lang'=>request('lang'),
           'indice_content'=>'name',
           'content_trans'=>request('name')]
         );
       }
       else{
         $data_trans=array(
           ['id_content_trans'=>$function->id,
           'content'=>$function['name'],
           'tipo_content'=>$tipo_content,
           'trans_lang'=>request('lang'),
           'indice_content'=>'name',
           'content_trans'=>request('name')],
           ['id_content_trans'=>$function->id,
           'content'=>$function['description'],
           'tipo_content'=>$tipo_content,
           'trans_lang'=>request('lang'),
           'indice_content'=>'description',
           'content_trans'=>request('description')]
         );
       }


      $this->storeTranslate($data_trans);
      return $function;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, int $functionIncluded)
    {
      $this->validator($request->all())->validate();
      $functions_included=FunctionIncluded::findOrFail($functionIncluded);
      $functions_included->name=request('name');
      $functions_included->description=request('description');
      $functions_included->update();
      return $functions_included;
    }

    public function updateTranslatedFunctionByLang(string $locale,$function_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'name'=> 'required|max:255',
      ]);

      $function=FunctionIncluded::find($function_id);
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);
      $data_trans=[];

      if(request('description')==''||request('description')==null){
        $data_trans=array(
          ['id_content_trans'=>$function_id,
          'content'=>request('name'),
          'tipo_content'=>$tipo_content,
          'trans_lang'=>$lang,
          'indice_content'=>'name',
          'content_trans'=>request('name')]
        );
      }
      else{
        $data_trans=array(
          ['id_content_trans'=>$function_id,
          'content'=>request('name'),
          'tipo_content'=>$tipo_content,
          'trans_lang'=>$lang,
          'indice_content'=>'name',
          'content_trans'=>request('name')],
          ['id_content_trans'=>$function_id,
          'content'=>request('description'),
          'tipo_content'=>$tipo_content,
          'trans_lang'=>$lang,
          'indice_content'=>'description',
          'content_trans'=>request('description')]
        );
      }
      $result=$this->updateTranslate($data_trans);
      return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,int $functionIncluded)
    {
      $function_included=FunctionIncluded::findOrFail($functionIncluded);
        $contentType='Function';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($functionIncluded,$tipo_content);
      $function_included->delete();
      return $function_included;
    }
}
