<?php
// namespace database\seeds;

use Illuminate\Database\Seeder;
use database\seeds\BooksTableSeeder;
use database\seeds\UserSeeder;
use database\seeds\MemberTableSeeder;
use database\seeds\TransactionSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('BooksTableSeeder');
        $this->call('UserSeeder');
        $this->call('MemberTableSeeder');
        $this->call('TransactionSeeder');
    }
}
