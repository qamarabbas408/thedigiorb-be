<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public static function getStatsBySection(string $section): Collection
    {
        return static::where('section', $section)
            ->where('status', 'published')
            ->orderBy('display_order')
            ->get();
    }
}
