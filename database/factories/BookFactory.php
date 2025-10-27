<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Category;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'category_id' => Category::factory(),
            'publisher' => $this->faker->company(),
            'isbn' => $this->faker->isbn13(),
            'edition' => $this->faker->randomDigitNotZero() . 'ª',
            'year' => $this->faker->year(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'shelf_location' => strtoupper($this->faker->bothify('?#')),
            'is_active' => true,
            'cover_name' => '/assets/images/defaults/genbook.png',
            'validity_date' => $this->faker->date('Y-m-d', '+1 year'),
        ];
    }
}
