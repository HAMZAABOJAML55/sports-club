<?php

namespace Database\Seeders;

use App\Models\Foodsystem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodsyStemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foodsystems')->delete();

        $foodsystems = [

            [
                'en'=> 'breakfast',
                'ar'=> 'الافطار'
            ],
            [

                'en'=> 'lunch',
                'ar'=> 'الغذاء'
            ],
            [

                'en'=> 'dinner',
                'ar'=> 'العشاء'
            ],

        ];

        foreach ($foodsystems as $n) {
            FoodSystem::create(
                ['name' => $n,
                ]
            );
        }
    }
}
