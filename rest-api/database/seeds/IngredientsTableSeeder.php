<?php

use App\Ingredient;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::query()->delete();
        $faker = \Faker\Factory::create();
        $ingredients = [
            [
                'name' => 'Salt',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pepper',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chicken',
                'description' => $faker->sentence(),
                'category' => 'Meat',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pork',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Beef',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        for ($i = 0, $len = 50; $i < $len; $i += 1) {
            $ingredients[] = [
                'name' => $faker->colorName(),
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->addMinute($i + 1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->addMinute($i + 1)->format('Y-m-d H:i:s'),
            ];
        }
        DB::table('ingredients')->insert($ingredients);
    }
}
