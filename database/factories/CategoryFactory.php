<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{

    public function definition()
    {


        return [
            'name'=>$this->faker->sentence(4),
            'type'=>$this->faker->randomElement(['electronic','phone','laptop']),
            'description'=>$this->faker->text(400),
            'colors'=>$this->faker->colorName(),
            'price'=>$this->faker->numberBetween(100000,1000000),
            'company'=>$this->faker->randomElement(['oppo','vivo','samsung','apple','tecno','acer','dell','hp']),
            'qty'=>$this->faker->randomDigitNotZero(),
            'populer'=>$this->faker->randomElement(['1','0']),
            'available'=>$this->faker->randomElement(['1','0']),
            'image'=>$this->faker->imageUrl(),

        ];
    }
}
