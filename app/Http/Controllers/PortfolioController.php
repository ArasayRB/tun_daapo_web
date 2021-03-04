<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Traits\ServiceTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
  use ServiceTrait, ImageTrait;

  public function __construct()
  {
      $this->middleware('auth');
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

  public function getPortfolio($portfolio){
    $portfolios=Portfolio::with('services')
                 ->where('id',$portfolio)
                 ->first();
    return $portfolios;
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
      if (request('img_url')!=""){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
      $portfol=Portfolio::findOrFail($portfolio->id);
      $this->delImageFile($portfol->img,'portfolio');
      $portfol->delete();
      $portfol->services()->detach();
    }
}
