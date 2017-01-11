<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
/**
 * user ctrl
 */
class UserController extends Controller
{
	protected $hasher;
	public function __construct()
	{
		$this->hasher = app()->make('hash');
	}

    public function postLogin(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');

    	$userlogin = User::where('email', $email)->first();
    	if (!$userlogin) {
    		return response()->json(['status'=>'false', 'msg'=>'email or password salah']);
    	} else {
    		if ($this->hasher->check($password, $userlogin->password)) {
    			$api_token = sha1(time());
    			$create_token = User::find($userlogin->id_user)->update(['api_token'=>$api_token]);
    			if ($create_token) {
    				return response()->json(['status'=>'true', 'msg'=>'success', 'token'=>$api_token, 'data'=>$userlogin]);
    			}
    		}
    	}
    }

    // user register
    public function register(Request $request)
    {
    	$register = User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> $this->hasher->make($request->input('password'))
        ]);
        // cek if success 
        if ($register) {
        	return response()->json(['status'=>'true', 'msg'=>'success register']);
        }else{
        	return response()->json(['status'=>'false', 'msg'=>'failed register']);
        }
    }

    public function getUser(Request $request, $id)
    {
    	$user = User::findOrFail($id);
    	// cek if success 
        if ($user) {
        	return response()->json(['status'=>'true', 'msg'=>'success', 'data'=>$user]);
        }else{
        	return response()->json(['status'=>'false', 'msg'=>'failed', 'data'=>'']);
        }
    }
}