<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LogsActivity;

    protected static $logFillable = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function routeNotificationForSlack() {
        return "https://hooks.slack.com/services/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";
    }
    public function Folders()
    {
        return $this->hasMany('App\folder');
    }
    public function Podcasts()
    {
        return $this->hasMany('App\podcasts');
    }

    public function hasRole($role) {
        $roleUser = $this->roles->pluck('slug');
        if($roleUser->contains($role))
            return true;
        return false;
    }
    public function PaymentAccounts()
    {
        return $this->hasMany('App\PaymentAccount');;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withPivot(['date_start', 'date_end']);
    }
   
    public function Payments()
    {
        return $this->hasMany('App\Payment')->with('Funnel')->with('Video');
    }
   
    public function level()
    {
        $level = $this->roles()->max("level");
        if(!$level)
            return 0;
    	return $level;
    }
   
    
    public function AutoResponders(){
        return $this->hasMany('App\AutoResponder')->orderByDesc('id');
     }


     

     public function recording()
     {
         return $this->hasMany('App\recording');
     }

    public function users()
    {
    	return $this->hasMany('App\User', 'created_by', 'id');
    }

    

  
    public function whitelabel()
    {
        return $this->hasMany('App\Whitelabel');
    }
    public function Brand()
    {
        return $this->hasOne('App\Whitelabel');
    }
    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function Medias()
    {
        return $this->hasMany('App\Media');
    }

    public function Pages()
    {
        return $this->hasMany('App\Page');
    }



   
    public function Chapters()
    {
        return $this->hasMany('App\Chapter');
    }

  
   
}
