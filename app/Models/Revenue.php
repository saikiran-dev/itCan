<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [];

    public function service() 
    {
    	return $this->belongsTo('App\Models\Service', 'service_id');
    }

}
