<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$faker = Faker::create();
		foreach (range(1, 50) as $key) {
			DB::table('member')->insert([
			'uid' => $faker->uuid(),
			'name' => $faker->name(),
			'date_of_birth' => $faker->date('Y-m-d', 'now'),
			'active'=>'Y',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			]);
		}
}
}