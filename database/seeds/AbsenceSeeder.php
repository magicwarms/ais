<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
use Faker\Factory as Faker;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('id_ID');
    	foreach (range(1,100) as $index) {
	        DB::table('absent_students')->insert([
	            'students_id' => $faker->numberBetween(1, 100),
	            'class_id' => $faker->numberBetween(1, 100),
	            'code' => $faker->numberBetween(1, 2),
	            'remark' => $faker->sentence(2, true),
	            'input_by' => 1,
	        ]);
		}
    }
}
