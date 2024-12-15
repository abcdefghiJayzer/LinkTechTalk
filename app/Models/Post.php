<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Allow mass-assignment for the image field
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'image',  // Add this line to allow mass assignment for the image field
    ];

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship to Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relationship to Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
