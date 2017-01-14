<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Book model
 */
class Book extends Model
{
	protected $table = 'books';
	protected $primaryKey = 'id';
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'author'];

    public static $rules = [
            'title'=> 'required',
            'description'=>'required',
            'author'=>'required',
            ];
}