<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
use Faker\Factory as Faker;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('id_ID');
    	foreach (range(1,100) as $index) {
	        DB::table('subjects')->insert([
	            'name' => $faker->sentence(2, true),
	            'code' => $faker->unique()->numberBetween(1000, 9000),
	            'status' => 1,
	        ]);
		}
    }
}
