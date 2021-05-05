<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

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
     * The pis that belong to the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pis()
    {
        return $this->belongsToMany(Pi::class, 'customer_pi', 'customer_id', 'pi_id');
    }
}
