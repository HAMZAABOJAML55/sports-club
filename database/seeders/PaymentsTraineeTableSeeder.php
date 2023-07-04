<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Paymentstrainee;
use App\Models\Subtype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTraineeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymentstrainees')->delete();

        $nationals = [
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
            Paymentstrainee::create(['name' => $n]);
        }

    }
}
