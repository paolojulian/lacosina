<?php

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
        DB::table('ingredients')->truncate();
        $faker = \Faker\Factory::create();
        $ingredients = [
            [
                'name' => 'Salt',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pepper',
                'description' => $faker->sentence(),
                'category' => 'Base',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('ingredients')->insert($ingredients);
    }
}
