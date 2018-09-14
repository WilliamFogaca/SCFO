<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use DB;

use Image;

class ProfileController extends Controller
{
    
    public function index(){
        $input = false;
        $permitido = true;
        return view('auth.profile', ['input' => $input, 'permitido' => $permitido], array('user' => Auth::user()) );
    }
    
    public function ativaInput(){
        $input = true;
        $permitido = true;
        return view('auth.profile', ['input' => $input, 'permitido' => $permitido], array('user' => Auth::user()) );
    }
    
    public function update(Request $request){
        $email = $request->email;
        $users = DB::table('users')->where('cpf', \Auth::user()->cpf)->update(['email' => $email]);
        return redirect()->route('auth.profile');
    }
    
    function verificaExtensao($extensao){
        $extPermitidas = array("png", "jpeg", "jpg");
		for($i = 0; $i < sizeof($extPermitidas); $i++){
			if(strcasecmp($extPermitidas[$i], $extensao) == 0){
				return true;
		  	}
		}
		return false;
        
    }
    
    public function update_avatar(Request $request){
        $input = false;
        $permitido = true;
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		$extensao = substr($filename, strrpos($filename, '.') + 1);
    		if($this->verificaExtensao($extensao) == true){
    		    
        		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
    
        		$user = Auth::user();
        		$user->avatar = $filename;
        		$user->save();
    		}else{
    		    $permitido = false;
    		    return view('auth.profile', ['input' => $input, 'permitido' => $permitido], array('user' => Auth::user()));
    		}
    		
    	}

    	return view('auth.profile', ['input' => $input, 'permitido' => $permitido], array('user' => Auth::user()));

    }
    
    
}
