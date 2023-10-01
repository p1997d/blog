<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition(): array
    {
        return [            
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraph,
            'category_id' => Category::inRandomOrder()->first()->id,
            'author' => User::factory(),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
