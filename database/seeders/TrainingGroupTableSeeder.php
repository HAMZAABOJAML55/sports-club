<?php

namespace Database\Seeders;

use App\Models\TrainingGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_groups')->delete();

        $training_groups = [

            [
                'en'=> ' Shoulder',
                'ar'=> ' كتف'
            ],
            [

                'en'=> 'Back',
                'ar'=> ' ظهر'
            ],
            [

                'en'=> 'Released',
                'ar'=> 'صدر'
            ],

            [

                'en'=> 'Legs ',
                'ar'=> ' ارجل'
            ],
            [

                'en'=> 'Arm',
                'ar'=> ' ذراع'
            ],
            [

                'en'=> 'Belly ',
                'ar'=> ' بطن'
            ],



        ];

        foreach ($training_groups as $n) {
            TrainingGroup::create(['name' => $n]);
        }

    }
}
