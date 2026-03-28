<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'description',
        'icon',
        'featured',
        'display_order',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'display_order' => 'integer',
    ];
}
