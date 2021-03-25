<?php

namespace App\Http\Controllers;

use App\Models\SectionPage;
use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\SectionPageTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Validator;

class SectionPageController extends Controller
{
  use ImageTrait, ContentTypeTrait, TranslateTrait, LanguageTrait, SectionPageTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function updateTranslatedSectionByLang($section_id,$lang_name, Request $request){
    $dataPost=request()->validate([
      'title'=> 'required|max:255',
      'description'=> 'required',
    ]);

    $section=SectionPage::find($section_id);
    $contentType='Section';
    $tipo_content=$this->findContentId($contentType);

    $lang=$this->getLangIdByName($lang_name);


    $data_trans=array(
      ['id_content_trans'=>$section_id,
      'content'=>request('title'),
      'tipo_content'=>$tipo_content,
      'trans_lang'=>$lang,
      'indice_content'=>'title',
      'content_trans'=>request('title')],
      ['id_content_trans'=>$section_id,
      'content'=>request('description'),
      'tipo_content'=>$tipo_content,
      'trans_lang'=>$lang,
      'indice_content'=>'description',
      'content_trans'=>request('description')]
    );
    $result=$this->updateTranslate($data_trans);
    return $result;
  }



  public function getNoTransLangItem(int $idItem){
    $languages=$this->getLanguagesList();
    $newListTranslate=[];
    $contentType='Section';
    $tipo_content=$this->findContentId($contentType);
    $languages_translated=$this->getItemTranslatesLanguageById($idItem,$tipo_content);
    if($languages_translated!='no-language-added'){
    foreach ($languages as $trans) {
      if(array_search($trans->language,$languages_translated)===false){
        $newListTranslate[]=$trans;
         }
       }
      return $newListTranslate;
     }
     return $languages;
  }

  public function getAllSectionPages(Request $request){
    $filter=$request->searcher;
    $section_pages=SectionPage::filterByAttribute($filter)
                    ->get();
    $section_pages_searched=[];
    foreach($section_pages as $section_page){
      $findText=stristr($section_page->title,$filter);
      if(!empty($findText)){
        $prop='title';
        $section_page->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $section_page->name=$section_page->title;
        $section_page->substr=$small_word;
        $section_page->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$section_page->title);
        $section_pages_searched[]=$section_page;
      }
    }
    return $section_pages_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'title' => ['required', 'string'],
          'description' => ['required', 'string'],
      ]);
  }

  protected function validatorUpd(array $data)
  {
      return Validator::make($data, [
          'title' => ['required', 'string'],
          'description' => ['required', 'string'],
      ]);
  }

  public function getSectionPageList(){
    $sections=SectionPage::all();
    return $sections;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.page_resources.section_page.index');
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

      $section_page=new SectionPage();
      if(request('img')!=''&&request('img')!=null){

        $newFileName=$this->manageImageFile(request('img'),'section_page');
        $section_page->img=$newFileName;
      }
      $section_page->title=request('title');
      $section_page->description=request('description');
      $section_page->save();

      return $section_page;
    }

    public function addTranslateSection(Request $request){
      $data=request()->validate([
        'title'=> 'required|max:255',
        'lang'=> 'required',
        'description'=> 'required',
      ]);

      $section=SectionPage::find(request('section_id'));
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$section->id,
        'content'=>$section['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'title',
        'content_trans'=>request('title')],
        ['id_content_trans'=>$section->id,
        'content'=>$section['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $this->storeTranslate($data_trans);
      return $section;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionPage  $sectionPage
     * @return \Illuminate\Http\Response
     */
    public function show(SectionPage $sectionPage)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionPage  $sectionPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $sectionPage)
    {

      $section_page=SectionPage::findOrFail($sectionPage);
      $newFileName;
      if (request('img')!=""){
        $this->validator($request->all())->validate();
        $newFileName=$this->manageImageFile(request('img'),'section_page');

        if($section_page->img!=null && $section_page->img!=''){
        $this->delImageFile($section_page->img,'section_page');
      }
          $section_page->img=$newFileName;
      }
      else{
        $this->validatorUpd($request->all())->validate();
      }
      $section_page->title=request('title');
      $section_page->description=request('description');
      $section_page->update();
      return $section_page;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionPage  $sectionPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $sectionPage)
    {  $section_page=SectionPage::findOrFail($sectionPage);
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $this->deleteTranslatedItemsByItem($sectionPage,$tipo_content);
      if($section_page->img!='' || $section_page->img!=null){
      $this->delImageFile($section_page->img,'section_page');
    }
      $section_page->delete();
    }
}
