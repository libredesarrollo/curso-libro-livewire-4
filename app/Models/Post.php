<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

#[Fillable(['title', 'slug', 'date', 'image', 'text', 'description', 'posted', 'type', 'category_id'])]
class Post extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'datetime'
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeFilterDataTable($query, array $filters)
    {
        $query
            ->when($filters['type'] ?? null, fn ($q, $type) => $q->where('type', $type))
            ->when($filters['category_id'] ?? null, fn ($q, $id) => $q->where('category_id', $id))
            ->when($filters['posted'] ?? null, fn ($q, $posted) => $q->where('posted', $posted))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where(fn ($q) => $q
                ->orWhere('id', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
            ))
            ->when($filters['from'] && $filters['to'], fn ($q) => $q->whereBetween('date', [
                date($filters['from']),
                date($filters['to']),
            ]))
            ->when($filters['sortColumn'] ?? null, fn ($q, $col) => $q->orderBy($col, $filters['sortDirection'] ?? 'desc'));
    }

    public function getImageURL(): string
    {
        if ($this->image === '') {
            return URL::asset('images/default.jpg');
        }

        return URL::asset('images/post/'.$this->image);
    }
}
