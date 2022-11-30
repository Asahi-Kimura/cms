<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,3),
            'questionnaire' => $this->faker->randomElement(['checked','']),
            'company_business' => $this->faker->randomElement(['checked','']),
            'contact' => $this->faker->randomElement(['checked','']),
            'job_offer' => $this->faker->randomElement(['checked','']),
            'others' => $this->faker->randomElement(['checked','']),
            'company_name' => Str::random('10'),
            'user_name' => Str::random('10'),
            'tele_num' =>  sprintf('%03d',random_int(0,100)).'-'.sprintf('%04d',random_int(0,9999)).'-'.sprintf('%03d',random_int(0,9999)),
            'email' => $this->faker->safeEmail(),
            'birthday' => $this->faker->date($format='Y-m-d',$max='now'),
            'sex' => $this->faker->randomElement(['male','female','others']),
            'job' => $this->faker->randomElement(['civil_servant','teacher','it_related','medical']),
            'content' => $this->faker->text(),
            //管理者側表示 
            'status' => '1'
        ];
    }
}
