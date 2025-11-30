<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3);
        
        return [
            'title'        => $title,
            'slug'         => Str::slug($title) . '-' . Str::random(4),
            'description'  => fake()->paragraph(5),
            'year'         => fake()->year(),
            'pages'        => fake()->numberBetween(100, 500),
            'cover'        => 'seeds/cover.jpg', 
            'pdf_file'     => 'seeds/dummy.pdf'
        ];
    }
}