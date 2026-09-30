<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'description',
        'category',
        'year',
        'thumbnail',
        'file_url',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
