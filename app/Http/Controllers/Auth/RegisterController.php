<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_no'=>['required','string', 'min:8', 'max:15'],
            'gender' => ['required', 'string', 'max:15'],
            'date_of_birth' => ['required', 'string', 'max:15'],
            'location' => ['required', 'string', 'max:255'],
            'writing_preference' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable|image|mimes:jpeg,png,jpg,svg|max:250'], //Max 250KB
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone'=>$data['phone'],
            'mobile_no'=>$data['mobile_no'],
            'gender'=>$data['gender'],
            'date_of_birth'=>$data['date_of_birth'],
            'location'=>$data['location'],
            'writing_preference'=>$data['writing_preference'],
            'profile_image'=>$data['profile_image'],
        ]);
    }

    public function register(Request $request)
    {
        $this->create();
    }
}
