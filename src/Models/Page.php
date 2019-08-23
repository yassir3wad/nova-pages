<?php

namespace Yassir3wad\NovaPages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name', 'template', 'slug', 'status', 'data', 'seo'];

    protected $casts = ['data' => 'array', 'seo' => 'array'];

    protected $attributes = [
        'status' => self::STATUS_DRAFT
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
}
