<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [];

    public function user() 
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function revenue() 
    {
    	return $this->hasMany('App\Models\Revenue', 'service_id');
    }
}
