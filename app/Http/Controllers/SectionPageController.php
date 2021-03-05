<?php

namespace App\Http\Controllers;

use App\Models\SectionPage;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Validator;

class SectionPageController extends Controller
{
  use ImageTrait;

  public function __construct()
  {
      $this->middleware('auth');
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
      $this->delImageFile($section_page->img,'section_page');
      $section_page->delete();
    }
}
