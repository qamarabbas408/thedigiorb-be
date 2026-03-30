<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalStat extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'key',
        'label',
        'value',
        'icon',
        'display_order',
        'status',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function toStatFormat(string $section = 'global'): array
    {
        return [
            'id' => $this->id,
            'section' => $section,
            'label' => $this->label,
            'value' => $this->value,
            'icon' => $this->icon,
            'display_order' => $this->display_order,
            'status' => $this->status,
            'is_global' => true,
            'global_key' => $this->key,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
