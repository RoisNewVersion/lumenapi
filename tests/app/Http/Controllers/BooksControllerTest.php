<?php
namespace Tests\App\Http\Controllers;

use TestCase;

class BooksControllerTest extends TestCase
{

	/** @test **/
	public function index_should_return_a_collection_of_records()
	{
		$this->get('/books')->seeJson([
			'title' => 'War of the Worlds'
			])
		->seeJson([
			'title' => 'A Wrinkle in Time'
			]);
	}

	/** @test **/
	public function show_should_return_a_valid_book()
	{
		// $this->markTestIncomplete('Pending test');
		$this->get('/books/1')
			->seeStatusCode(200);
	}

	/** @test **/
	public function show_should_fail_when_the_book_id_does_not_exist()
	{
		// $this->markTestIncomplete('Pending test');
		$this->get('/books/999')
			->seeStatusCode(404)
			->seeJson([
				'error'=>
					['message'=>'Book not found']
				]);
	}

	/** @test **/
	public function show_route_should_not_match_an_invalid_route()
	{
		$this->markTestIncomplete('Pending test');
	}
}