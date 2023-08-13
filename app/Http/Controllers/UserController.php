<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BuyPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{

    public function index()
    {
        $isWeb = auth()->guard('web')->check();
        if ($isWeb) {
            $roleAdmin = auth()->user()->hasRole('admin');
            $gender = auth()->user()->gender;
            if ($roleAdmin) {
                if ($gender === 'male') {
                    $users = User::role('client')->where('gender', 'male')->get();
                } elseif ($gender === 'female') {
                    $users = User::role('client')->where('gender', 'female')->get();
                }
            } else {
                $users = User::role('client')->get();
            }
        } else {
            $isCoach = auth()->guard('coach')->check();
            $roleCoach = auth('coach')->user()->hasRole('coach');
            $gender = auth('coach')->user()->gender;
            if ($roleCoach) {
                $coach = auth('coach')->user();
                $trainingSessions = $coach->trainingSessions;
                $attendances = Attendance::whereIn('training_session_id', $trainingSessions->pluck('id'))->get();
                $usersInSessions = $attendances->filter(function ($attendance) use ($gender) {
                    return $attendance->users->gender === $gender;
                })->pluck('users')->unique();
                $users = $usersInSessions;
            }
            return view('users.index', data: [
                'users' => $users,
                'attendances' => $attendances
            ]);
        }

        return view('users.index', data: [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            return view('users.create');
        }
    }

    public function show($userID)
    {
        $user = User::findOrFail($userID);
        return view('users.show', ['user' => $user]);
    }

    // public function store(StoreUserRequest $request)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|unique:users|email',
            'passwd' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:passwd',
            'date_of_birth' => 'required|date',
        ]);
        // dd($request);
        $img = $request->file('profile_img');

        if ($img != null) :
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs//' . 'users'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        // handle creator
        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->profile_img = $imageName;
        $newUser->date_of_birth = $request->input('date_of_birth');
        $newUser->gender = $request->input('gender');
        $newUser->description = $request->input('description');
        $newUser->email_verified_at = now();
        $newUser->assignRole('client');
        $newUser->save();
        //redirection to posts.index
        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
        $user = User::find($userId);

        return view("users.edit", [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->date_of_birth = $request->input('date_of_birth');
        $isSaved = $user->save();

        return redirect()->route('users.index');
    }

    public function destroy($userId)
    {
        $checkAttendance = Attendance::where('user_id', $userId)->first();
        $checkBuyPackage = BuyPackage::where('user_id', $userId)->first();


        if ($checkAttendance == null && $checkBuyPackage == null) {

            $oldimg = User::where('id', $userId)->first()->profile_img;
            if ($oldimg != "Client.png") {
                // to delete old image
                if (file::exists(public_path('imgs//' . 'users/' . $oldimg))) {
                    file::delete(public_path('imgs//' . 'users/' . $oldimg));
                }
            }

            User::findOrFail($userId)->delete();
            return to_route('users.index')
                ->with('success', 'user deleted successfully');
        } else {
            return redirect()->route('users.index')
                ->with('errorMessage', 'cannt be deleted');
        }
    }

    public function editProfile()
    {
        return view('profile.editProfile');
    }

    public function updateProfile(Request $request)
    {
        //        dd($request);
        $userID = $request->id;

        $validated = $request->validate([
            'name' => 'required|max:50|min:3',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userID],
            'date_of_birth' => 'required|date',
        ]);

        $oldimg = $request->oldimg;
        //        dd($request);

        if ($request->hasFile('profile_img')) {
            $request->validate([
                'profile_img' => 'image | mimes:jpg,jpeg,png',
            ]);

            $imageName = time() . '.' . $request->file('profile_img')->extension();
            $request->file('profile_img')->move(public_path('imgs//' . 'users'), $imageName);
            //            dd($imageName);
            DB::table('users')->where('id', '=', $userID)->update(['profile_img' => $imageName]);

            if ($oldimg != "Client.png") {
                // to delete old image
                if (file::exists(public_path('imgs//' . 'users/' . $oldimg))) {
                    file::delete(public_path('imgs//' . 'users/' . $oldimg));
                }
            }
        }

        User::find($userID)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            //            'profile_img' => $imageName
        ]);
        return redirect()->route('dashboard');
    }

    public function editPassword()
    {
        $msg = 0;
        return view('profile.editPassword', ["msg" => $msg]);
    }

    public function updatePassword(Request $request)
    {
        $userid = Auth::id();
        //        dd($userid);

        $data = $request->validate([
            'newpassword' => 'required|min:6',
            'oldpassword' => 'required|min:6'
        ]);

        $userPassword = Auth::user()->password;

        $newPassword = Hash::make($data['newpassword']);

        if (Hash::check($data['oldpassword'], $userPassword)) {     // check if enter old password correct or not

            DB::table('users')->where('id', '=', $userid)->update(['password' => $newPassword]);
            return redirect()->route('dashboard');
        } else {
            $msg = 'please enter your old password correctly';
            return view('profile.editPassword', ['msg' => $msg]);
        }
    }


    public function ban($user)
    {
        User::findOrFail($user)->ban([
            'comment' => 'لقد تم انتهاء الإشتراك مع فترة التمديد!',
        ]);
        $verfiyUser = User::findOrFail($user);
        $verfiyUser->email_verified_at = null;
        $verfiyUser->save();
        return redirect()->route('users.index');
    }

    public function unban($user)
    {
        User::findOrFail($user)->unban();
        $verfiyUser = User::findOrFail($user);
        $verfiyUser->email_verified_at = now();
        $verfiyUser->save();
        return redirect()->route('users.index');
    }

    public function banView()
    {
        $bannedUsers = User::onlyBanned()->get();
        return view('users.banned', [
            "bannedUsers" => $bannedUsers
        ]);
    }


    public function logout(Request $request)
    {
        $this->middleware('auth');
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('signIn');
    }
}
