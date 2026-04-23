<?php
namespace Database\Factories;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory<Shift>
 */
class ShiftFactory extends Factory {
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array {
        $startDate = fake()->dateTimeBetween('now', '+3 months');
        $isOvernight = fake()->boolean(20); // 20% chance of overnight shift
        $endDate = $isOvernight ? (clone $startDate)->modify('+1 day') : $startDate;
        return [
            'user_id' => null,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'start_time' => fake()->time('H:i:s'),
            'end_time' => fake()->time('H:i:s')
        ];
    }
    public function assigned(): static {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory()
        ]);
    }
    public function overnight(): static {
        return $this->state(function (array $attributes) {
            $start = \Carbon\Carbon::parse($attributes['start_date']);
            return [
                'end_date' => $start->addDay()->format('Y-m-d')
            ];
        });
    }
}