<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('id_ID');
    	foreach (range(1,100) as $index) {
	        DB::table('students')->insert([
	            'class_id' => $faker->numberBetween(1, 100),
	            'parents_id' => $faker->numberBetween(1, 100),
	            'name' => array_random([$faker->firstNameMale, $faker->firstNameFemale]),
	            'nis' => $faker->unique()->numberBetween(10000, 90000),
	            'address' => $faker->address,
	            'birthday' => $faker->date('Y-m-d', 'now'),
	            'gender' => array_random([1, 2]),
	            'status' => 1,
	            'photo_file' => $faker->imageUrl(640, 480, 'people'),
	            'password' => bcrypt('admin1234'),
	        ]);
		}
    }
}
