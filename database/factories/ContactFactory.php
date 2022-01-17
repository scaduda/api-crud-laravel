<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'people_id' => People::factory(),
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber()
        ];
    }
}
