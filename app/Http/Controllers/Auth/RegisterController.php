<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRegisterRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:password',
            'userImg' => 'image|mimes:jpg,jpeg',
            'date_of_birth' => 'required|date',
            'description' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function createUser(Request $request)
    {
        $imageName = $this->uploadUserImage($request->file('userImg'));

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->profile_img = $imageName;
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender = $request->input('gender');
        $user->description = $request->input('description');
        $user->save();

        return $user;
    }

    protected function uploadUserImage($image)
    {
        if ($image) {
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//users'), $imageName);
        } else {
            $imageName = 'Client.png';
        }
        return $imageName;
    }

    protected function initializeUser(User $user)
    {
//        $user = User::where('id', $user->email)->first();
        $user->assignRole('client');
        $banData = [
            'comment' => 'مستخدم جديد',
            'bannable_id' => $user->id,  // Pass the user's ID here
            'bannable_type' => get_class($user),
        ];

        $user->ban($banData);
    }


    public function register(Request $request)
    {
        $validator = $this->validateRegisterRequest($request);
        $user = $this->createUser($request);
        $this->initializeUser($user);
        // Redirect the user to a page where they can see the details of the user and approve it
        if ($user->save()) {
            return redirect()->route('signIn');
        } else {
            return Redirect::back()->withErrors($validator->errors());
        }
    }
}
