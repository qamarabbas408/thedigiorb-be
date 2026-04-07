<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public static function getPublished(): Collection
    {
        return static::where('status', 'published')
            ->orderBy('display_order')
            ->get();
    }
}
