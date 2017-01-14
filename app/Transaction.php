<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Transaction
 */
class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['book_id', 'member_id', 'borrow_date', 'return_date', 'active'];

    // relation to member table
    public function member()
    {
    	// belongsTo(RelatedModel, foreignKey = member_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    // relation to book table
    public function book()
    {
    	// belongsTo(RelatedModel, foreignKey = book_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Member::class, 'book_id', 'id');
    }

    public static $rules = [
    	'book_id'=>'required', 
    	'member_id'=>'required',
    	'borrow_date'=>'required', 
    	'return_date'=>'required', 
    	'active'=>'required'];
}