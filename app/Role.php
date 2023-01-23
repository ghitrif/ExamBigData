<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;
    protected static $logFillable = true;
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'description','level', 'product_id'
    ];
    protected $hidden = [
        'product_id',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
