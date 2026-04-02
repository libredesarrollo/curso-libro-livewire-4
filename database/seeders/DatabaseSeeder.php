<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        // ]);

        Category::factory(10)->create();
        Tag::factory(20)->create();
        Post::factory(50)->create();
    }
}
