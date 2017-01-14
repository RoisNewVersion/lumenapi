<?php 

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
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
			DB::table('transaction')->insert([
			'book_id' => mt_rand(1, 50),
			'member_id' => mt_rand(1, 50),
			'borrow_date' => $faker->date(),
			'return_date'=> $faker->dateTimeBetween('-4 days', '+19 days'),
			'active'=>'Y',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			]);
		}
}
}