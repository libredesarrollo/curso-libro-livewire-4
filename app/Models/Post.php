<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\URL;

#[Fillable(['title', 'slug','date','image','text','description','posted','type', 'category_id'])]
class Post extends Model
{
    use HasFactory;
    // protected $fillable=['title', 'slug','date','image','text','description','posted','type', 'category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
    function getImageURL()
    {
        if($this->image == '' ){
            return URL::asset("images/default.jpg");
        }
        return URL::asset("images/post/" . $this->image);
    }
}
