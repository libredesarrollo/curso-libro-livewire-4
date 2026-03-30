<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'image', 'text'])]
class Category extends Model
{
    use HasFactory;
    // protected $fillable=['title','slug','image','text'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}