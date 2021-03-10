<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permssion;
use App\Traits\UserTrait;
use App\Notifications\VerifyEmailNotify;
use App\Notifications\ResetPasswordNotify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'imagn_url',
        'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%')
                        ->orWhere('email', 'LIKE', '%'.$filter.'%');
      }
    }

    public function roles(){
      return $this->belongsToMany(Role::class,'role_user','user_id','role_id')->withTimestamps();
    }
  public function permissions(){
      return $this->belongsToMany(Permission::class,'permission_user','user_id','permission_id')->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true;
            }
        }
        return false;
    }

    public function checkPermission(){
      $permissions=[];
      foreach (auth()->user()->permissions as $permiso) {
        $permissions[]=$permiso->slug;
      }
      //$result=in_array($permiso,$permission);
      return $permissions;
    }

    public function isAdmin()
    {
      if($this->roles->contains('slug','admin'))
      {
        return true;
      }
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasRoleBySlug($role){

      if(strpos($role,',')!==false){
        $listRoles=explode(',',$role);
        foreach ($listRoles as $rol) {
          if($this->roles->contains('slug',$rol)){
            return true;
          }
        }


        }
        else if($this->roles->contains('slug',$role)){
          return true;
        }
        return false;
      }

      public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotify);
    }

    public function sendPasswordResetNotification($token)
      {
          $this->notify(new ResetPasswordNotify($token));
      }
}
