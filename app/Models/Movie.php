<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'year',
        'category_id',
        'cover_image',
        'trailer_link',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
