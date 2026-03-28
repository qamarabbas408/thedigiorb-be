<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'section',
        'label',
        'value',
        'icon',
        'display_order',
        'status',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];
}
