<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->morphOne('App\Models\Customer', 'logable');
    }
    public function link()
    {
        return $this->morphOne('App\Models\Link', 'logable');
    }
    public function pi()
    {
        return $this->morphOne('App\Models\Pi', 'logable');
    }
    public function product()
    {
        return $this->morphOne('App\Models\Product', 'logable');
    }
    public function role()
    {
        return $this->morphOne('App\Models\Role', 'logable');
    }
    public function user()
    {
        return $this->morphOne('App\Models\User', 'logable');
    }

}
