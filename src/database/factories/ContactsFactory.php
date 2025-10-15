<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contacts::class;

    public function definition()
    {
        $faker = FakerFactory::create('ja_JP');

        $date_created = $faker->dateTimeBetween('2025-10-01', '2025-10-10');
        $date_updated = $faker->dateTimeBetween('2025-10-11', '2025-10-15');
        
        return [
            'category_id' => $this->faker->numberBetween(1,5),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $faker->safeEmail,
            'tel' => $faker->phoneNumber,
            'address' => $faker->address,
            'building' => $faker->optional()->randomElement([
                '〇〇マンション',
                '△△ビル',
                'コーポ〇〇',
                'メゾン△△',
                'レジデンス〇〇',
            ]),
            'detail' => $this->faker->realText(120),
            'created_at' => $date_created,
            'updated_at' => $date_updated,
        ];
    }
}
