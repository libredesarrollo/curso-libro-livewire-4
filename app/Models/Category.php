<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

#[Fillable(['title', 'slug', 'image', 'text'])]
class Category extends Model
{
    use HasFactory;

    // protected $fillable=['title','slug','image','text'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getImageUrl()
    {
        return URL::asset('images/category/'.$this->image);
    }

    public function scopeFilterDataTable($query, array $filters)
    {
        $query
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where(fn ($q) => $q
                ->orWhere('id', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
            ))
            ->when($filters['sortColumn'] ?? null, fn ($q, $col) => $q->orderBy($col, $filters['sortDirection'] ?? 'desc'));
    }
}
