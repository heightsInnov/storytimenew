<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Validator, DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Notification;
use App\Notifications\EmailActivation;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth')->except('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('is_activated', '0')->where('is_verified', '0')->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => '1', 'disabled' => '0', 'is_verified' => '1', 'is_approved' => '1', 'is_admin' => '1'])) {
            return redirect()->route('dashboard');
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => '1', 'disabled' => '0', 'is_verified' => '1', 'is_approved' => '1', 'is_story_teller' => '1'])) {
            return redirect()->route('teller_dashboard');
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => '1', 'disabled' => '0', 'is_verified' => '1', 'is_approved' => '1', 'is_story_seeker' => '1'])) {
            return redirect()->route('seeker_dashboard');
        }elseif ($user) {
            return redirect()->back()->withErrors('Your account has not been activated nor verified');
        } else {
            return redirect()->back()->withErrors('The credentials do not match our records.');
        }

    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    /**
     * Get logged in user role
     *
     * @param  User object
     */
    // protected function userRole($user)
    // {
    //     $roles = config('roles.models.role')::pluck('slug');

    //     foreach ($roles as $value) {
    //         if ($user->hasRole($value)){
    //             $userRole = $value;
    //             break;
    //         }
    //     }

    //     return $userRole;
    // }

     /**
     * Change Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $credentials = $request->only('user_id', 'old_password', 'new_password');

        $rules = [
            'new_password' => 'required|min:5'
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['error'=> true, 'message'=> 'Password should be up to 6 characters', 'data' => null]);
        }

        $getUser = User::find($request->user_id);

        if (! Hash::check($request->old_password, $getUser->password)) {
            return response()->json([
                'error'=> true,
                'message' => 'Error enter the current password correctly',
                'data' => null
            ], 403);
        }

        $password = $request->new_password;

        $updatePassword = $getUser->update(['password' => Hash::make($password)]);

        if (!$updatePassword) {
            return response()->json([
                'error'=> true,
                'message' => 'Error occured password was not updated',
                'data' => null
            ], 403);
        }

        return response()->json([
            'error'=> false,
            'message' => 'Password updated successfully',
            'data' => null
        ]);
    }

    //Register new user
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'mobile_no'=>['required','string', 'min:8', 'max:15'],
            'gender' => ['required', 'string', 'max:15'],
            'date_of_birth' => ['required', 'string', 'max:15'],
            'location' => ['required', 'string', 'max:255'],
            'writing_preference' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image','mimes:jpeg,png,jpg,svg|max:250'], //Max 250KB
            // 'gender' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();
            if ($request->hasFile('profile_image')) {
                $fileExt = $request->profile_image->getClientOriginalExtension();
                $name = $request->profile_image.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
                $imageName = config('app.url').'/assets/avatars/'.$name;
                $storeFile = $request->profile_image->move(public_path('assets/avatars'), $imageName);
            } else {
                $imageName = null;
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->mobile_no = $request->mobile_no;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->location = $request->location;
            $user->writing_preference = $request->writing_preference;
            $user->profile_image = $imageName;
            $user->code       = uniqid();
            if($request->has('is_story_seeker')){
                $user->is_story_seeker = 1;
            }elseif($request->has('is_story_teller')){
                $user->is_story_teller = 1;
            }
            if($user->save()){
                DB::commit();
                Notification::send($user, new EmailActivation());

                return redirect()->route('login')->with('success', 'An activation email has been sent to ' . $user->email. '. Click the button in the email to activate and verify your account.');
            }else{
                return redirect()->back()->withErrors('Your account could not be verified at this time.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('Your account could not be created at this time.');
        }
    }

    public function verifyUser($id, $code)
    {
        $user = User::where('id', $id)->where('code', $code)->first();
        return view('auth.verify', compact('user', 'id', 'code'));
    }

    public function verifyUser2(Request $request, $id, $code)
    {
        $user = User::where('id', $id)->where('code', $code)->first();

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password         = bcrypt($request->new_password);
            $user->is_activated     = 1;
            $user->is_verified      = 1;
            $user->is_approved      = 1;
            $user->changed_password = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect()->route('login')->with('success', 'Password changed successfully. Your account has been activated and verified, please login to continue.');
        } else {
            return redirect()->back()->withErrors('Current password is wrong.');
        }
    }
}
