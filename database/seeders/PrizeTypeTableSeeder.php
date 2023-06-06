<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Prize;
use App\Models\Subtype;
use App\Models\TournamentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrizeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes')->delete();

        $nationals = [

            [
                'en'=> 'monetary',
                'ar'=> 'نقدي'
            ],
            [

                'en'=> 'medal',
                'ar'=> 'ميدالية'
            ],
            [

                'en'=> 'Memorial medal',
                'ar'=> 'وسام تذكاري'
            ],
            [

                'en'=> 'Free subscriptions',
                'ar'=> 'اشتراكات مجانية'
            ],
        ];

        foreach ($nationals as $n) {
            Prize::create(['name' => $n]);
        }

    }
}
