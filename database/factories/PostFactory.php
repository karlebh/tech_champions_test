<?php

namespace Database\Factories;

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
  public function definition(): array
  {
    $title = fake()->sentence();

    return [
      'user_id' => rand(1, 10),
      'title' => $title,
      'slug' => str()->slug($title),
      'body' => fake()->words(200, true),
    ];
  }
}
