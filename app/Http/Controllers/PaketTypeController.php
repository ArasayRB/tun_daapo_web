<?php

namespace App\Http\Controllers;

use App\Models\PaketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketTypeController extends Controller
{

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function show(PaketType $paketType)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $paketType)
    {
      $this->validator($request->all())->validate();
      $paket_types=PaketType::findOrFail($paketType);
      $paket_types->name=request('name');
      $paket_types->update();
      return $paket_types;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketType  $paketType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $paketType)
    {
      $paket_type=PaketType::findOrFail($paketType);
      $paket_type->delete();
      return $paket_type;
    }
}