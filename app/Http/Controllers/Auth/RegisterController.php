<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    protected function create(array $data)
    {
        if (array_key_exists("userImg", $data)) :
            $img = $data['userImg'];
        else :
            $img = null;
        endif;

        if ($img != null) :
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs//' . 'users'), $imageName);
        else :
            $imageName = 'Client.png';
        endif;
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_img' => $imageName,
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'description' => $data['description'],
        ]);
        //        save user when the admin is approving it
        $user->save();
        $user->ban([
            'comment' => 'its new resister user',
        ]);

        $user->assignRole('client');
        $saved = $user->save();
        if ($saved) {
            return redirect()->route('signIn');
        } else {
            return response()->json(
                ['message' => $data->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
//        return $user;
    }


    public function store(Request $request)
    {
        $user = $this->create($request->all());

        // Redirect the user to a page where they can see the details of the user and approve it
        return redirect()->route('users.show', $user->id);
    }

    public function register(Request $request)
    {
        // Redirect the user to a page where they can see the details of the user and approve it
        return redirect()->route('signIn');
    }
}
