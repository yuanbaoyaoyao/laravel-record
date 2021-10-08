<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $addresses=[
            ["部门1","使用者1"],
            ["部门2","使用者2"],
            ["部门3","使用者3"],
            ["部门4","使用者4"],
            ["部门5","使用者5"],
        ];
        $address = $this->faker->randomElement($addresses);

        return [
            'department' => $address[0],
            'user' => $address[1],
            'contact_phone' => $this->faker->phoneNumber(),
        ];
    }
}
