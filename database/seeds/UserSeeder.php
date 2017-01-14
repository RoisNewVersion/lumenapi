<?php 

use Illuminate\Database\Seeder;
use Carbon\Carbon;
/**
 * users seeder
 */
class UserSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->insert([
			'name'=>'roisul',
			'email'=>'roisnewversion@gmail.com', 
			'password'=>app('hash')->make('admin'),
			'api_token'=>sha1(time()),
			'created_at'=>Carbon::now(),
			'updated_at'=>Carbon::now(),
			]);
	}
}
?>