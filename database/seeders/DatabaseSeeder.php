<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(sub_LocationTableSeeder::class);
        $this->call(EmploymenttypesTableSeeder::class);
        $this->call(ProfDegreeTableSeeder::class);
        $this->call(SubtypeTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(FoodsyStemTableSeeder::class);
        $this->call(TrainingGroupTableSeeder::class);
        $this->call(TournamentTypeTableSeeder::class);
        $this->call(PrizeTypeTableSeeder::class);
        $this->call(ChampionshipLevelTableSeeder::class);
        $this->call(PaymentsTraineeTableSeeder::class);


    }
}
