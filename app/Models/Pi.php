<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pi extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }



    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer');
    }

}
