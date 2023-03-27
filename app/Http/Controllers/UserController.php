<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    //Show create account form
    public function create(){
        return view('users.createaccount');
    }

    //Rules for form inputs
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' =>['required','confirmed', 'min:6'],
        ]);

        //Hash password for security messueres
        $formFields['password'] = bcrypt($formFields['password']);

        //Create secion and log in user
        $user = User::create($formFields);
        
        auth()->login($user);

        return redirect('/dashboard')->with('message', 'User created and logged in succesfully');

    }

    //Logout User
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User loged out succesfully');
    }

    //Login User
    public function login(){
        return view('users.login');
    }

    public function loginuser(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' =>['required'],
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/dashboard')->with('message', 'User logged in succesfully');
        }

        return back()->withErrors(['email' =>'Invalid Credentials'])->onlyInput('email');
    }
}

?>