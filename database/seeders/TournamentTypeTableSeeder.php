<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Subtype;
use App\Models\TournamentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TournamentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournament_types')->delete();

        $nationals = [

            [
                'en'=> 'indoor tournament',
                'ar'=> 'بطولة داخلية'
            ],
            [

                'en'=> 'local tournament',
                'ar'=> 'بطولة محلية'
            ],
            [

                'en'=> 'global tournament',
                'ar'=> 'بطولة عالمية'
            ],
        ];

        foreach ($nationals as $n) {
            TournamentType::create(['name' => $n]);
        }

    }
}
