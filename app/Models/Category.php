<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'filter_class',
        'icon',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];
}
