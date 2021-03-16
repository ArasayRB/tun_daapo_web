<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Traits\ServiceTrait;
use App\Traits\PortfolioTrait;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
  use ServiceTrait, ImageTrait, PortfolioTrait, ContentTypeTrait,  TranslateTrait,  LanguageTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllPortfolios(Request $request){
    $filter=$request->searcher;
    $portfolios=Portfolio::filterByAttribute($filter)
                    ->get();
    $portfolios_searched=[];
    foreach($portfolios as $portfolio){
      $findAddress=stristr($portfolio->project_name,$filter);
      $findText=stristr($portfolio->empresa_solicitante,$filter);
      if(!empty($findText)){
        $prop='empresa_solicitante';
        $portfolio->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $portfolio->substr=$small_word;
        $portfolio->name=$portfolio->empresa_solicitante;
        $portfolio->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$portfolio->empresa_solicitante);
        $portfolios_searched[]=$portfolio;
      }
      if(!empty($findAddress)){

          $prop='project_name';
          $portfolio->finded==$findAddress;
          $small_word=substr($findAddress,0,strlen($filter));
          $portfolio->substr=$small_word;
          $portfolio->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$portfolio->project_name);
          $portfolios_searched[]=$portfolio;
      }
    }
    return $portfolios_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'empresa_solicitante' => ['required', 'string', 'max:255'],
          'project_name' => ['required', 'string'],
          'description' => ['required', 'string'],
          'service_id' => ['required', 'string'],
      ]);
  }

  protected function validatorUpd(array $data)
  {
      return Validator::make($data, [
          'empresa_solicitante' => ['required', 'string', 'max:255'],
          'project_name' => ['required', 'string'],
          'description' => ['required', 'string'],
          'service_id' => ['required', 'string'],
      ]);
  }


  public function availableService()
  {
    $services=$this->getAllService();
    $services_array=[];
    foreach ($services as $service) {
      $services_array[]=array('key'=>'',
                              'value'=>$service->name);
    }

      return $services_array;
  }

  public function getPortfolioList(){
    $portfolios=Portfolio::with('services')
                         ->get();
    return $portfolios;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page_resources.portfolio.index');
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
      $newFileName=$this->manageImageFile(request('img'),'portfolio');

      $services;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }

      $portfolio=new Portfolio();
      $portfolio->img=$newFileName;
      $portfolio->empresa_solicitante=request('empresa_solicitante');
      $portfolio->project_name=request('project_name');
      $portfolio->description=request('description');
      $portfolio->service_id=request('service_id');
      $portfolio->save();


      if(is_array($services)){
        foreach($services as $servic){
          $existService=$this->getServiceIf($servic);

          $portfolio->services()->attach($existService->id);
        }
      }
      else{
        $existService=$this->getServiceIf($services);
        $portfolio->services()->attach($existService->id);
      }

      $portToAdd=$this->getPortfolio($portfolio->id);
      return $portToAdd;
    }

    public function addTranslate(Request $request){
      $data=request()->validate([
        'lang'=> 'required',
        'description'=> 'required',
      ]);

      $portfolio=Portfolio::find(request('portfolio_id'));
      $contentType='Portfolio';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$portfolio->id,
        'content'=>$portfolio['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $this->storeTranslate($data_trans);
      return $portfolio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {

      $portfol=Portfolio::findOrFail($portfolio->id);
      $newFileName;
      if (request('img')!=""){
        $this->validator($request->all())->validate();
        $newFileName=$this->manageImageFile(request('img'),'portfolio');

        $this->delImageFile($portfol->img,'portfolio');
          $portfol->img=$newFileName;
      }
      else{
        $this->validatorUpd($request->all())->validate();
      }
      $services;
      if(strpos(request('service_id'), ',')){
        $services = explode(",", request('service_id'));
      }
      else{
        $services=request('service_id');
      }
      $portfol->empresa_solicitante=request('empresa_solicitante');
      $portfol->project_name=request('project_name');
      $portfol->description=request('description');
      $portfol->service_id=request('service_id');
      $portfol->update();

      $portfol->services()->detach();
      if(is_array($services)){
        foreach($services as $servic){
          $existService=$this->getServiceIf($servic);

          $portfolio->services()->attach($existService->id);
        }
      }
      else{
        $existService=$this->getServiceIf($services);
        $portfolio->services()->attach($existService->id);
      }

      $portToAdd=$this->getPortfolio($portfolio->id);
      return $portToAdd;
    }

    public function updateTranslatedPortfolioByLang($portfolio_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'description'=> 'required',
      ]);

      $portfolio=Portfolio::find($portfolio_id);
      $contentType='Portfolio';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);


      $data_trans=array(
        ['id_content_trans'=>$portfolio_id,
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
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
      $portfol=Portfolio::findOrFail($portfolio->id);
        $contentType='Portfolio';
        $tipo_content=$this->findContentId($contentType);
        $this->deleteTranslatedItemsByItem($portfolio->id,$tipo_content);
      $this->delImageFile($portfol->img,'portfolio');
      $portfol->delete();
      $portfol->services()->detach();
    }
}
