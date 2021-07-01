<?php

namespace App\Models;

use App\Scopes\Deleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class DeliveryLocation extends Model
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
}
