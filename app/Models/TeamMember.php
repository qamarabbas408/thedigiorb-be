<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'team_members';

    protected $fillable = [
        'id',
        'name',
        'role',
        'bio',
        'image',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'display_order',
        'status',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];
}
