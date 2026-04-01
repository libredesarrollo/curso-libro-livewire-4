<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'image', 'text'])]
class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeFilterDataTable($query, array $filters)
    {
        $query
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where(fn ($q) => $q
                ->orWhere('id', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%')
            ))
            ->when($filters['sortColumn'] ?? null, fn ($q, $col) => $q->orderBy($col, $filters['sortDirection'] ?? 'desc'));
    }
}
