<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
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
			DB::table('books')->insert([
			'title' => $faker->sentence(),
			'description' => $faker->paragraph(),
			'author' => $faker->name(),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			]);
		}
}
}