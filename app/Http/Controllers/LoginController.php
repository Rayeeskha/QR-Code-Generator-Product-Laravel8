<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Storage;
class LoginController extends Controller{
    public function index() {
        if (session()->has('USER_LOGIN')) {
            return redirect('admin/dashboard');
        }else{
            return view('Main.login');
        }
    }
    public function authentication(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->post('email');
        $password = $request->post('password');
        $result = Login::where(['email'=> $email])->get();
        if (isset($result[0])) {
            if (Hash::check($request->post('password'), $result[0]->password)) {
                if ($result[0]->status == "Active") {
                    if ($request->rememberme === null) {
                        setcookie('userlogin_email', $request->post('email'), 100);
                        setcookie('userlogin_pwd', $request->post('password'), 100);
                    }else{
                        setcookie('userlogin_email', $request->post('email'), time()+60*60*24*100);
                        setcookie('userlogin_pwd', $request->post('password'), time()+60*60*24*100);
                    }
                    $admin_session = [
                        'USER_ID'       => $result[0]->id,
                        'USER_ROLE'     => $result[0]->role,
                        'USER_NAME'     => $result[0]->name,
                        'USER_EMAIL'    => $result[0]->email,
                        'USER_PASSWORD' => $result[0]->password,
                        'USER_PROFILE'  => $result[0]->profiles,
                        'USER_LOGIN'    => true,
                    ];
                    $request->session()->put($admin_session);
                    return redirect('admin/dashboard');
                }else{
                    $request->session()->flash('error', 'Your Account is not Verified by Admin');
                    return redirect('Login'); 
                }
            }else{
               $request->session()->flash('error', 'Please Enter Correct Password');
                return redirect('Login'); 
            }
        }else{
            $request->session()->flash('error', 'Sorry ! Incorrect Login Details');
            return redirect('Login');
        }
    }

   


    public function updatepassword(){
        $pass = Login::find(1);
        $pass->password = Hash::make('123456');
        $pass->save();
    }

    public function signup(){
        return view('Main.signup');
    }

    public function registeraccount(Request $request){
        $request->validate([
            'image'        => 'mimes:jpeg,jpg,png',
            'name'         => 'required',
            'email'        => 'required|email|unique:logins,email',
            'mobile'       => 'required|digits:10|numeric',
            'password'     => 'required',
            'State'        => 'required',
            'city'         => 'required',
            'address'      => 'required',
        ]);
        $model = new Login();
        if ($request->hasfile('profiles')) {
            $image = $request->file('profiles');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/users', $image_name); 
            $model->profiles =  $image_name;
        }
        $model->name       =  $request->post('name');
        $model->lname      =  $request->post('lname');
        $model->email      =  $request->post('email');
        $model->password   =  Hash::make($request->post('password'));
        $model->dummypass  =  $request->post('password');
        $model->mobile     =  $request->post('mobile');
        $model->total_qr   =  10;
        $model->total_hits =  15;
        $model->pinocde    =  $request->post('pinocde');
        $model->State      =  $request->post('State');
        $model->city       =  $request->post('city');
        $model->address    =  $request->post('address');
        $model->status     = 'Active';
        $model->role       =  2;
        $model->save();
        $request->session()->flash('success', 'Account Created Successfully');
        return redirect('Login');
       
    }






   
}
