<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Subtype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subtypes')->delete();

        $nationals = [

            [
                'en'=> 'daily',
                'ar'=> 'يومي'
            ],
            [

                'en'=> 'weekly',
                'ar'=> 'اسبوعي'
            ],
            [

                'en'=> 'monthly',
                'ar'=> 'شهري'
            ],

            [

                'en'=> 'Three Months',
                'ar'=> 'ثلاثة أشهر'
            ],
            [

                'en'=> 'Six Months',
                'ar'=> 'ستة أشهر'
            ],
            [

                'en'=> 'yearly',
                'ar'=> 'سنوي'
            ],


        ];

        foreach ($nationals as $n) {
            Subtype::create(['name' => $n]);
        }

    }
}
