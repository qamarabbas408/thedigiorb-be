<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Project extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'category_id',
        'year',
        'technologies',
        'description',
        'image',
        'gallery',
        'featured',
        'display_order',
        'client',
        'url',
        'status',
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery' => 'array',
        'featured' => 'boolean',
        'display_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public static function getPublished(): Collection
    {
        return static::where('status', 'published')
            ->orderBy('display_order')
            ->get();
    }
}
