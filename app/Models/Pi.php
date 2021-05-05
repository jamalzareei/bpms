<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pi extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The products that belong to the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'pi_product');
    }

    // public function products()
    // {
    //     return $this->belongsToMany('App\Models\Product');
    // }

    /**
     * The customers that belong to the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_pi', 'pi_id', 'customer_id');
    }


    // public function customers()
    // {
    //     return $this->belongsToMany('App\Models\Customer');
    // }

}
