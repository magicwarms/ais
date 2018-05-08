<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
use Faker\Factory as Faker;

class TeachersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        $faker = Faker::create('id_ID');
    	foreach (range(1,100) as $index) {
	        DB::table('teachers')->insert([
	            'name' => $faker->name,
	            'address' => $faker->address,
	            'birthday' => $faker->date('Y-m-d', 'now'),
	            'code' => $faker->unique()->numberBetween(1000, 9000),
	            'gender' => array_random([1, 2]),
	            'education' => 'Sarjana Pendidikan S1',
	            'status' => 1,
	            'photo_file' => $faker->imageUrl(640, 480, 'people'),
	            'password' => bcrypt('admin1234'),
	        ]);
		}
    }
}
