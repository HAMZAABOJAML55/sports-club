<?php

namespace Database\Seeders;

use App\Models\Employment_type;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\ProductType;
use App\Models\Subtype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->delete();

        $nationals = [

            [
                'en'=> 'product',
                'ar'=> 'منتج'
            ],
            [

                'en'=> 'service',
                'ar'=> 'خدمـة'
            ],
            [

                'en'=> 'Training system',
                'ar'=> 'نظام تدريب'
            ],

            [

                'en'=> 'consultation',
                'ar'=> 'استشارة'
            ],

        ];

        foreach ($nationals as $n) {
            ProductType::create(['name' => $n]);
        }

    }
}
