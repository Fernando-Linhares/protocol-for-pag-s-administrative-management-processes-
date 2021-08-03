<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name,
            'content'=>$this->faker->sentence(),
            'unit'=>rand(1000,4000),
            'number'=>rand(2000,3000),
            'vol'=>rand(10,20),
            'user_id'=>rand(1,30),
            'acepted'=>true
        ];
    }
}
