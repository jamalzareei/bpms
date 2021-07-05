<?php

namespace App\Models;

use App\Scopes\Deleted;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    
    protected static function booted()
    {
        static::addGlobalScope(new Deleted());
    }
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get all of the pis for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pis()
    {
        return $this->hasMany(Pi::class);
    }

    /**
     * Get the factory that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
    
    /**
     * Get the country that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * The factories that belong to the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function factories()
    {
        return $this->belongsToMany(Factory::class);
    }

}
