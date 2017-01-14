<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaction;
use Validator;

class TransactionController extends Controller
{
    public function index($show = 10)
    {
    	return Transaction::with('member', 'book')->paginate($show);
    }

    public function show($id)
    {
    	if ($data = Transaction::with('book', 'member')->find($id)) {
            return $data;
        }else{
            return response()->json([
                'msg'=>'Transaction not found',
                'err'=>true,
                'res'=>false,
                'data'=>''
                ], 404);
        }
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), Transaction::$rules);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create transaction', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        if ($transaction = Transaction::create($this->input($request))) {
            return response()->json([
                'msg'=>'Transaction Created succesfully', 
                'err'=>false, 
                'res'=>$transaction
                ]);
        }else{
            return response()->json([
                'msg'=>'Failed create transaction', 
                'err'=>true, 
                'res'=>false
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Transaction::$rules);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create transaction', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        $data = Transaction::findOrFail($id);

        if ($data->update($this->input($request))) {
            return response()->json([
                'msg'=>'Transaction Updated succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed update transaction', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Transaction::find($id);

        if ($data) {
        	$data->delete();
            return response()->json([
                'msg'=>'Transaction deleted succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed delete transaction', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function input($request)
    {
        return $data = [
            'book_id'=> $request->input('book_id'),
            'member_id'=>$request->input('member_id'),
            'borrow_date'=>$request->input('borrow_date'),
            'return_date'=>$request->input('return_date'),
            'active'=>$request->input('active')
        ];
    }
}