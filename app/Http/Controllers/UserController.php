<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index');
    }

    public function updateUser(Request $request)
    {
        
        $data = User::find($request->id);
        $data->username = $request->username;
        
        if($request->password){
            if($request->password != $request->password_confirmation){

                $json['message'] = 'รหัสผ่านไม่ถูกต้อง';
                $json['success'] = false;
                return response()->json($json);
            }else{
                
                $data->password = Hash::make($request->password);
            }
        }
        
        
        $data->save();
        $json['message'] = '';
        $json['success'] = true;
        return response()->json($json);
    }
}
