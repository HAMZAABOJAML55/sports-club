<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmploymenttypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employmenttypes')->delete();

        $nationals = [

            [
                'en'=> 'Official employee',
                'ar'=> 'موظف رسمي'
            ],
            [

                'en'=> 'Part-time',
                'ar'=> 'عمل جزئي'
            ],
            [

                'en'=> 'Advisor',
                'ar'=> 'استشاري'
            ],

            [

                'en'=> 'Food management',
                'ar'=> 'ادارة الأغذية'
            ],
            [

                'en'=> 'Follow up exercises',
                'ar'=> 'متابعة التمارين'
            ],


        ];

        foreach ($nationals as $n) {
            Employment_type::create(['name' => $n]);
        }

    }
}
