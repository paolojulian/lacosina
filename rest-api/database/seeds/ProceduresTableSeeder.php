<?php

use App\Procedure;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procedure::query()->delete();
        $faker = \Faker\Factory::create();
        $procedures = [
            [
                'name' => 'Sautee',
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
                'duration_from_minute' => 3,
                'duration_to_minute' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Stir Fry',
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
                'duration_from_minute' => 20,
                'duration_to_minute' => 30,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Reduce',
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
                'duration_from_minute' => 20,
                'duration_to_minute' => 30,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Deep Fry',
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
                'duration_from_minute' => 20,
                'duration_to_minute' => 30,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        for ($i = 0, $len = 50; $i < $len; $i += 1) {
            $procedures[] = [
                'name' => $faker->colorName(),
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
                'duration_from_minute' => rand(1, 20),
                'duration_to_minute' => rand(20, 40),
                'created_at' => Carbon::now()->addMinute($i + 1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->addMinute($i + 1)->format('Y-m-d H:i:s'),
            ];
        }
        DB::table('procedures')->insert($procedures);
    }
}
