<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
use Faker\Factory as Faker;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('id_ID');
    	foreach (range(1,100) as $index) {
	        DB::table('parents')->insert([
	            'name' => $faker->name,
	            'address' => $faker->address,
	            'phone' => $faker->unique()->phoneNumber,
	            'gender' => array_random([1, 2]),
	            'status' => 1,
	            'password' => bcrypt('admin1234'),
	        ]);
		}
    }
}
