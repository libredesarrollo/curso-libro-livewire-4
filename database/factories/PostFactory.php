<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'image' => fake()->imageUrl(800, 600, 'post'),
            'text' => fake()->paragraphs(5, true),
            'description' => fake()->paragraph(2),
            'posted' => fake()->randomElement(['yes', 'not']),
            'type' => fake()->randomElement(['post', 'advert', 'course']),
            'category_id' => Category::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post) {
            $tags = Tag::factory()->count(fake()->numberBetween(2, 5))->create();
            $post->tags()->attach($tags);
        });
    }
}
