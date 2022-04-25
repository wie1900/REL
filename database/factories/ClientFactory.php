<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = rand(1,2);

        if($type == 1){
            $lname = $this->faker->lastName();
            return [
                'name' => $lname,
                'fname' => $this->faker->firstName(),
                'shortname' => $lname,
                'address' => $this->faker->address(1,40),
                'nip' => $this->faker->numerify('##########'),
                'gen' => '2001-01-01',
                'clienttype_id' => 1
            ];
        }

        if($type == 2){
            $comp = $this->faker->company();

            if(str_contains($comp, " ")) {
                $arr = explode(" ", $comp);
                $first = str_replace(",", "", $arr[0]);
            } else {
                $first = $comp;
            }

            return [
                'name' => $comp,
                'fname' => '',
                'shortname' => $first,
                'address' => $this->faker->address(),
                'nip' => $this->faker->numerify('##########'),
                'gen' => '2022-01-01',
                'clienttype_id' => 2
            ];
        }
    }
}
