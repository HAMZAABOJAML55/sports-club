<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Natinality;
use App\Models\Sub_Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sub_LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_locations')->delete();

        $nationals = [

            [
                'en'=> 'eldachahli',
                'ar'=> 'الدقهلية'
            ],
            [

                'en'=> 'elsharkia',
                'ar'=> 'الشرقية'
            ],
            [

                'en'=> 'cairo',
                'ar'=> 'القاهرة'
            ],

        ];

        foreach ($nationals as $n) {
            Sub_Location::create(
                ['name' => $n,
                 'location_id'=>3
                ]
            );
        }
    }
}
