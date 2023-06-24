<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Natinality;
use App\Models\Prof;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfDegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profs')->delete();

        $nationals = [

            [
                'en'=> 'Beginner',
                'ar'=> 'مبتدئ'
            ],
            [

                'en'=> 'Intermediate',
                'ar'=> 'متوسط'
            ],
            [

                'en'=> 'Advance',
                'ar'=> 'محترف'
            ],
            [

                'en'=> 'True Best',
                'ar'=> 'محترف جدا'
            ],

        ];

        foreach ($nationals as $n) {
            Prof::create(['name' => $n]);
        }

    }
}
