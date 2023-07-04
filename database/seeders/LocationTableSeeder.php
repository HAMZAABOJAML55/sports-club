<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Natinality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->delete();

        $nationals = [

            [
                'en'=> 'egypt',
                'ar'=> 'مصر'
            ],
            [

                'en'=> 'Palestine',
                'ar'=> 'فلسطين'
            ],
            [

                'en'=> 'gordan',
                'ar'=> 'الاردون'
            ],

        ];

        foreach ($nationals as $n) {
            Location::create(['name' => $n]);
        }

    }
}
