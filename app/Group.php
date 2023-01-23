<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
class Group extends Model
{
    use LogsActivity;
    protected static $logFillable = true;

    protected $table = 'group';
    protected $fillable = ["name", "description", "user_id"];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function prospects()
    {
        return $this->hasMany('App\Prospect');
    }

}
