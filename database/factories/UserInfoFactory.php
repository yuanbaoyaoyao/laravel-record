<?php

namespace Database\Factories;

use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $info=[
            ["部门1","使用者1"],
            ["部门2","使用者2"],
            ["部门3","使用者3"],
            ["部门4","使用者4"],
            ["部门5","使用者5"],
        ];
        $i = $this->faker->randomElement($info);

        return [
            'department' => $i[0],
            'user' => $i[1],
            'contact_phone' => $this->faker->phoneNumber(),
        ];
    }
}
