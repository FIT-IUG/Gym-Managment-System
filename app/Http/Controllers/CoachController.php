<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Mail\CoachPassword;
use App\Models\Coach;
use App\Models\CoachSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = $this->getCoachesData()[0];

        return view(
            'coaches.index',
            [
                'coaches' => $coaches
            ]
        );
    }

    public function create()
    {

        return view('coaches.create');
    }

    public function store(CoachRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|min:3',
//            'profile_image' => 'required|file|mimes:jpg,jpeg,png',
//            'description' => 'required|min:6',
//
//        ]);
//        dd($request);
        $img = $request->file('profile_image');
        if ($img != null) :
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs//' . 'coaches'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;
//        $requestedData = request()->all();
        $coach = new Coach();
        $coach->name = $request->input('name');
        $coach->email = $request->input('email');
        $coach->gender = $request->input('gender');
        $coach->password = Hash::make($request->input('password'));
        $coach->description = $request->input('description');
        $coach->profile_image = $imageName;
        $coach->assignRole('coach');
        $isSaved = $coach->save();

        return redirect()->route('coaches.index');
    }

    public function show($id)
    {
        $coach = Coach::findOrFail($id);
        return view('coaches.show', ['coach' => $coach]);
    }


    public function edit($id)
    {
        $coach = Coach::find($id);
        return view(
            'coaches.edit',
            [
                'coaches' => $coach,
            ]
        );
    }

    public function update($id, UpdateCoachRequest $request)
    {
        $formDAta = request()->all();
        $coach = Coach::find($id);
//        dd($coach);
        $previousImage = $coach->profile_image;
        $img = $request->file('profile_image');
        if ($img != null) {
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs/coaches'), $imageName);

            // Delete the previous image from storage if it exists
            if ($previousImage !== 'Client.Png' && file_exists(public_path('imgs/coaches/' . $previousImage))) {
                unlink(public_path('imgs/coaches/' . $previousImage));
            }
        } else {
            // If no new image is uploaded, keep the previous image
            $imageName = $previousImage;
        }
//        $requestedData = request()->all();
        $coach->name = $request->name;
//        $coach->gender = $request->gender;
        $coach->password = Hash::make($request->input('password'));
        $coach->description = $request->description;
        $coach->profile_image = $imageName;
        $isSaved = $coach->save();
        return redirect()->route('coaches.index');
    }


    public function destroy($id)
    {

        $coach = Coach::find($id);
        $checkSession = CoachSession::where('coach_id', $id)->first();

        if ($checkSession == null) {
            $coach->trainingSessions()->detach();
            $coach->delete();
            return to_route('coaches.index')
                ->with('success', 'Coach deleted successfully');
        } else {
            // return Redirect::back()->withErrors(['message' => 'delete']);
            return redirect()->route('coaches.index')->with('errorMessage', 'cannt be deleted');

        }
    }


    public function getCoachesData()
    {
        $isAdmin = auth()->user()->hasRole('admin');
        $gender = auth()->user()->gender;

        if ($isAdmin) {
            // Check the gender of the admin and filter users accordingly
            if ($gender === 'male') {
                $coaches = Coach::where('gender', 'male')->get();
            } elseif ($gender === 'female') {
                $coaches = Coach::where('gender', 'female')->get();
            }
        } else {
            // Non-admin users will see all coach
            $coaches = Coach::all();
        }

        return [$coaches];
    }

    public function loginCoashView()
    {
        $msg = 0;
        session()->put('guard', 'coach');
        $validator = Validator(['guard' => 'coach'], [
            'guard' => 'required|string|in:coach'
        ]);
        if (!$validator->fails()) {
            return response()->view('auth.loginCoach', ['msg' => $msg]);
        } else {
            abort(Response::HTTP_NOT_FOUND, 'The page you have requested is not found');
        }
    }

    public function loginCoash(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|exists:coaches,email",
            "password" => "required|string|min:7",
        ]);
        $guard = session()->get('guard');
//        dd($guard);
        // dd($request->input('password'),Hash::make($request->input('password')));
        if (!$validator->fails()) {
//            $coach = Coach::where('email', '=', $request->input('email'))->first();
//            if (Hash::check($request->input('password'), $coach->password)) {
//                $token = $coach->createToken('Coach')->accessToken;
//                $coach->setAttribute('token', $token);
//                return redirect()->route('dashboard');
//            } else {
//                return redirect()->route('login');
//            }
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard('coach')->attempt($credentials)) {
                return redirect()->route('dashboardCoach');
//                return response()->json(['message' => 'Login success'], Response::HTTP_OK);
            } else {
                return redirect()->route('coach.login_view');
            }
//            return $this->generatePGCT($request);
        } else {
            return
//                redirect()->route('coach.login_view')->with(['message' => $validator->getMessageBag()->first()],
//                Response::HTTP_BAD_REQUEST);
                response()->json(
                    ['message' => $validator->getMessageBag()->first()],
                    Response::HTTP_BAD_REQUEST
                );
        }
    }

    public
    function editProfile()
    {
        return view('profile.editCoachProfile');
    }

    public function editPassword()
    {
        $msg = 0;
        return view('profile.editCoachPassword', ["msg" => $msg]);
    }

    public function requestPassword()
    {
        return view('auth.passwords.resetCoach');
    }

    public function passwordEmail(Request $request)
    {
//        dd($request);
        $msg = 0;
        $coach = Coach::where('email', '=', $request->input('email'))->first();
//        dd(User::where('name', '=', 'adminMon')->first());
        $msg = 'لقد تم إرسال طلبك, سيتم تنفيذه بأسرع وقت ممكن';
        if ($coach->gender === 'male') {
            Mail::to(User::where('name', '=', 'admin')->first())->send(new CoachPassword($coach));
//            return view('emails.passwordForCoach', ['coach' => $coach, "msg" => $msg]);
//            return view('auth.loginCoach', ['coach' => $coach, "msg" => $msg]);
        } elseif ($coach->gender === 'female') {
            Mail::to(User::where('name', '=', 'adminMon')->first())->send(new CoachPassword($coach));
//            return view('emails.passwordForCoach', ['coach' => $coach, "msg" => $msg]);
//            return view('auth.loginCoach', ['coach' => $coach, "msg" => $msg]);
        }
        return redirect('/coach/login')->with('msg', $msg);
    }

    public function updatePassword(Request $request)
    {
        $coachId = auth('coach')->id();
//        dd($coachId);

        $data = $request->validate([
            'newpassword' => 'required|min:6',
            'oldpassword' => 'required|min:6'
        ]);

        $userPassword = auth('coach')->user()->password;

        $newPassword = Hash::make($data['newpassword']);

        if (Hash::check($data['oldpassword'], $userPassword)) {     // check if enter old password correct or not

            DB::table('coaches')->where('id', '=', $coachId)->update(['password' => $newPassword]);
            return redirect()->route('dashboard');
        } else {
            $msg = 'please enter your old password correctly';
            return view('profile.editPassword', ['msg' => $msg]);
        }
    }

    public
    function updateProfile(Request $request)
    {
//        dd($request);
        $coachID = $request->id;

        $validated = $request->validate([
            'name' => 'required|max:50|min:3',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:coaches,email,' . $coachID],
            'description' => 'required|max:50|min:10',
        ]);

        $oldimg = $request->oldimg;
//        dd($request);

        if ($request->hasFile('profile_image')) {
            $request->validate([
                'profile_image' => 'image | mimes:jpg,jpeg,png',
            ]);

            $imageName = time() . '.' . $request->file('profile_image')->extension();
            $request->file('profile_image')->move(public_path('imgs//' . 'coaches'), $imageName);
//            dd($imageName);
            DB::table('coaches')->where('id', '=', $coachID)->update(['profile_image' => $imageName]);

            if ($oldimg != "Client.png") {
                // to delete old image
                if (file::exists(public_path('imgs//' . 'coaches/' . $oldimg))) {
                    file::delete(public_path('imgs//' . 'coaches/' . $oldimg));
                }
            }
        }

        Coach::find($coachID)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'description' => $validated['description'],
//            'profile_image' => $imageName
        ]);
        return redirect()->route('dashboard');
    }
}
