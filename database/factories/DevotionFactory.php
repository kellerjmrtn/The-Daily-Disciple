<?php

namespace Database\Factories;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Devotion>
 */
class DevotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = Str::title($this->faker->words(rand(2, 4), true));
        $date = $this->faker->unique()->date('Y-m-d', '+2 weeks');

        // Create $num fake paragraphs as content
        $content = '';
        $num = rand(4, 15);

        for ($i = 0; $i < $num; $i++) {
            $content .= '<p>' . $this->faker->text(rand(200, 1000)) . '</p>';
        }

        return [
            'title' => $title,
            'subtitle' => rand(1, 3) === 1
                ? null
                : Str::title($this->faker->words(rand(2, 6), true)),
            'content' => $content,
            'date' => $date,
            'status' => $this->faker->randomElement(array_merge(
                array_fill(0, 7, Status::PUBLISHED),
                array_fill(0, 2, Status::UNPUBLISHED),
                array_fill(0, 1, Status::DRAFT),
            )),
            'slug' => Str::slug($title),
        ];
    }
}
