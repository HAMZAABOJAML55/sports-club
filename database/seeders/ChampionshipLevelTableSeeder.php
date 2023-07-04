<?php

namespace Database\Seeders;

use App\Models\ChampionshipLevel;
use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Subtype;
use App\Models\TournamentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChampionshipLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('championship_levels')->delete();

        $nationals = [

            [
                'en'=> 'junior',
                'ar'=> 'مبتدئ'
            ],
            [

                'en'=> 'average',
                'ar'=> 'متوسط'
            ],
            [

                'en'=> 'professional',
                'ar'=> 'محترف'
            ],
        ];

        foreach ($nationals as $n) {
            ChampionshipLevel::create(['name' => $n]);
        }

    }
}
