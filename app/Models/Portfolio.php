<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'title',
        'description',
        'image_url',
        'tags',
        'project_link',
        'source_link'
    ];

    protected $casts = [
        'tags' => 'array'
    ];
}