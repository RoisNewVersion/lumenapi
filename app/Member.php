<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Member model
 */
class Member extends Model
{
	protected $table = 'member';
	protected $primaryKey = 'id';
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['uid', 'name', 'birth_of_date', 'active'];

    public static $rules = [
            'name'=> 'required',
            'date_of_birth'=>'required',
            'active'=>'required',
            ];
}