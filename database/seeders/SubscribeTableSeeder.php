<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Subscribe;
use App\Models\Subtype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribes')->delete();

        $nationals = [
            [

                'en'=> 'monthly',
                'ar'=> 'شهري'
            ],


            [

                'en'=> 'yearly',
                'ar'=> 'سنوي'
            ],


        ];

        foreach ($nationals as $n) {
            Subscribe::create(['name' => $n]);
        }

    }
}
