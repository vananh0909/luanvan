<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => '0924546546',
            'password' => '$2y$12$8U7gfzQodezKwbhHJxHw1eoTDl2g.FbllbPWwY.eO8QXXQ6dbwnYi',

        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $roles = roles::where('name', 'doctor')->get();
            $user->roles()->sync($roles->pluck('id_roles')->toArray());
        });
    }
}
