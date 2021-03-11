<?php

namespace App\Http\Controllers;

use App\Models\FunctionIncluded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FunctionIncludedController extends Controller
{

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function show(FunctionIncluded $functionIncluded)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $functionIncluded)
    {
      $this->validator($request->all())->validate();
      $functions_included=FunctionIncluded::findOrFail($functionIncluded);
      $functions_included->name=request('name');
      $functions_included->description=request('description');
      $functions_included->update();
      return $functions_included;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunctionIncluded  $functionIncluded
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $functionIncluded)
    {
      $function_included=FunctionIncluded::findOrFail($functionIncluded);
      $function_included->delete();
      return $function_included;
    }
}
