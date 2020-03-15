<?php

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
        DB::table('procedures')->truncate();
        $faker = \Faker\Factory::create();
        $data = [
            [
                'name' => 'Sautee',
                'description' => $faker->sentence(),
                'image' => '',
                'duration_from_minute' => 3,
                'duration_to_minute' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Deep Fry',
                'description' => $faker->sentence(),
                'image' => '',
                'duration_from_minute' => 20,
                'duration_to_minute' => 30,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        DB::table('procedures')->insert($data);
    }
}
