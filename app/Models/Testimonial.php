<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'title',
        'company',
        'content',
        'rating',
        'image',
        'featured',
        'display_order',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'rating' => 'integer',
        'display_order' => 'integer',
    ];
}
