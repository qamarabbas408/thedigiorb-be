<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'is_active',
        'client',
        'url',
        'status',
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery' => 'array',
        'featured' => 'boolean',
        'display_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
