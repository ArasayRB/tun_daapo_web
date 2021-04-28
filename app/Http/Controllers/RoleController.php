<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Traits\RoleTrait;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  use RoleTrait,PermissionTrait;


     protected function validator(array $data)
     {
         return Validator::make($data, [
             'name' => 'required', 'max:255',
             'description' => 'required',
         ]);
     }  public function permissionsOfRole(string $language,int $role){
         $permissions=Role::with('permissions')
                          ->find($role);
                          $permissions_array;
                          foreach ($permissions->permissions as $permission) {
                            $permissions_array[]=array('key'=>$permission->id,
                                                'value'=>$permission->name);
                          }
                          return $permissions_array;
       }

       public function getRolesList(){
         $roles=Role::with('permissions')
                    ->orderBy('created_at','asc')
                    ->get();
         return $roles;
       }

       public function getAllRoles(Request $request){
         $filter=$request->searcher;
         $roles=Role::filterByAttribute($filter)
                         ->get();
         $roles_searched=[];
         foreach($roles as $role){
           $findAddress=stristr($role->email,$filter);
           $findText=stristr($role->name,$filter);
           if(!empty($findText)){
             $prop='name';
             $role->finded==$findText;
             $small_word=substr($findText,0,strlen($filter));
             $role->substr=$small_word;
             $role->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$role->name);
             $roles_searched[]=$role;
           }
         }
         return $roles_searched;
       }
         /**
          * Display a listing of the resource.
          *
          * @return \Illuminate\Http\Response
          */
         public function index()
         {
             return view('admin.roles.index');
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
             $role=new Role();
             $role->name=request('name');
             $role->description=request('description');
             $role->slug=Str::slug($role->name, '-');
             $role->save();
             $permissions;
             if(strpos(request('permissions'), ',')){
               $permissions = explode(",", request('permissions'));
             }
             else{
               $permissions=request('permissions');
             }
             if(is_array($permissions)){
             foreach ($permissions as $permission) {
               $role->permissions()->attach($permission);
             }
           }
           else{
             $role->permissions()->attach($permissions);
           }

             return $this->getRoleById($role->id);

         }

         /**
          * Update the specified resource in storage.
          *
          * @param  \Illuminate\Http\Request  $request
          * @param  \App\Models\Role  $role
          * @return \Illuminate\Http\Response
          */
         public function update(string $language,Request $request, Role $role)
         {
           $dataRole=request()->validate([
           'name'=> 'required|max:255',
           'description'=> 'required'
         ]);
           $role=Role::findOrFail($role->id);
           $role->name=request('name');
           $role->description=request('description');
           $role->slug=Str::slug($role->name, '-');
           $role->update();
           $role->permissions()->detach();
           $permissions;
           if(strpos(request('permissions'), ',')){
             $permissions = explode(",", request('permissions'));
           }
           else{
             $permissions=request('permissions');
           }
           if(is_array($permissions)){
           foreach ($permissions as $permission) {
             $role->permissions()->attach($permission);
           }
         }
         else{
           $role->permissions()->attach($permissions);
         }

           return $this->getRoleById($role->id);
         }

         /**
          * Remove the specified resource from storage.
          *
          * @param  \App\Models\Role  $role
          * @return \Illuminate\Http\Response
          */
         public function destroy(string $language,Role $role)
         {
           $role=Role::findOrFail($role->id);
           $role->permissions()->detach();
           $role->delete();
         }
}
