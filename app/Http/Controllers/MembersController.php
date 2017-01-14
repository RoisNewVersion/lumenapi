<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Member;
use Validator;
/**
 * members controller
 */
class MembersController extends Controller
{
    /**
     * summary
     */
    public function index()
    {
        return Member::paginate(10);
    }

    public function show($id)
    {
        if ($data = Member::find($id)) {
            return $data;
        }else{
            return response()->json([
                'msg'=>'Member not found',
                'err'=>true,
                'res'=>false,
                'data'=>''
                ], 404);
        } 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Member::$rules);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create member', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        if ($member = Member::create($this->input($request))) {
            return response()->json([
                'msg'=>'Member Created succesfully', 
                'err'=>false, 
                'res'=>$member
                ]);
        }else{
            return response()->json([
                'msg'=>'Failed create member', 
                'err'=>true, 
                'res'=>false
                ]);
        }
        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Member::$rules);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create member', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        $data = Member::findOrFail($id);

        if ($data->update($this->input($request))) {
            return response()->json([
                'msg'=>'Member Updated succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed update member', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Member::find($id);

        if ($data) {
        	$data->delete();
            return response()->json([
                'msg'=>'Member deleted succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed delete member', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function input($request)
    {
        return $data = [
            'uid'=> time(),
            'name'=>ucwords($request->input('name')),
            'date_of_birth'=>$request->input('date_of_birth'),
            'active'=>$request->input('active')
        ];
    }

}