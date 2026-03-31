<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        $title = fake()->unique()->word();

        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl(400, 400, 'tag'),
            'text' => fake()->sentence(),
        ];
    }
}
