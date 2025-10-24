<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->catchPhrase(), // More natural title
            'description' => $this->faker->paragraph(4, true), // 4 sentences in one paragraph
            'date' => $this->faker->dateTimeBetween('-2 months', 'now'), // Random recent date
        ];
    }
}
