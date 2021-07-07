<?php

namespace App\Models;

use App\Scopes\Deleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pi extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    protected static function booted()
    {
        static::addGlobalScope(new Deleted());
    }
    
    /**
     * The products that belong to the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'pi_products');
    }

    /**
     * Get the customer that owns the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all of the files for the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the factory that owns the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    /**
     * Get the deliverylocation that owns the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliverylocation()
    {
        return $this->belongsTo(DeliveryLocation::class, 'delivery_location_id', 'id');
    }
    
    /**
     * Get the currency that owns the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get all of the useraccess for the Pi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function useraccess()
    {
        return $this->hasOne(PiUser::class)->with('user')->latest();//->first();
    }
}
