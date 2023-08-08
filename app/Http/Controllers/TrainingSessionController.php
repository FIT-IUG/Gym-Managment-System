<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use Spatie\Period\Period;
use App\Models\CoachSession;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Period\PeriodCollections;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;
use App\Models\Attendance;
use App\Models\Session;
use Illuminate\Support\Facades\Redirect;

class TrainingSessionController extends Controller
{
    public function index()
    {

        $isWeb = auth()->guard('web')->check();
        if ($isWeb) {
            $roleAdmin = auth()->user()->hasRole('admin');
            $roleClient = auth()->user()->hasRole('client');
            if ($roleAdmin) {
                $sessions = TrainingSession::all();
                $coaches = Coach::all();
            } elseif ($roleClient) {
//            $sessions = Auth::user()->trainingSessions;
//            $trainingSessions = Auth::user()->training_session_id;
//            $attendance = Auth::user()->attendances;
                $user = Auth::user();
                $attendance = User::with('attendances.trainingSessions')->find($user->id);
                $sessions = $attendance->attendances->pluck('trainingSessions');
                $coaches = collect();

                foreach ($sessions as $session) {
                    $coaches = $coaches->merge($session->coaches);
                }
//                dd($coaches);
//                $coaches = Auth::user()->coaches;
                return view('sessions.index', [
                    'sessions' => $sessions,
                    'coaches' => $coaches
                ]);
            }
//        dd($trainingSessions);
            return view('sessions.index', [
                'sessions' => $sessions,
                'coaches' => $coaches
            ]);

        } else {
            $isCoach = auth()->guard('coach')->check();
            $roleCoach = auth('coach')->user()->hasRole('coach');
            if ($roleCoach) {
//            $sessions = Auth::user()->trainingSessions;
//            $trainingSessions = Auth::user()->training_session_id;
//            $attendance = Auth::user()->attendances;
                $coachId = auth('coach')->user()->id;
                $coach = Coach::find($coachId);
//            $trainingSessions = $coach->trainingSessions;
                $sessions = $coach->trainingSessions;
//            $attendance = User::with('attendances.trainingSessions')->find($user->id);
//            $sessions = $attendance->attendances->pluck('trainingSessions');
//            $coaches = Auth::user()->coaches;
                return view('sessions.index', [
                    'sessions' => $sessions,
//                'coaches' => $coaches
                ]);

            }
        }
    }

    public function create()
    {
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleClient = auth()->user()->hasRole('client');
        $gender = auth()->user()->gender;

        if ($roleAdmin) {
            // Check the gender of the admin and filter users accordingly
            $sessions = TrainingSession::all();
            if ($gender === 'male') {
                $coaches = Coach::where('gender', 'male')->get();
            } elseif ($gender === 'female') {
                $coaches = Coach::where('gender', 'female')->get();
            }
        } elseif ($roleClient) {
            $sessions = Auth::user()->trainingSessions;
            $coaches = Auth::user()->coaches;
        } else {
            // Non-admin users will see all coach
            $coaches = Coach::all();
        }

//        if ($roleAdmin) {
//            $sessions = TrainingSession::all();
//            $coaches = Coach::all();
//        } elseif ($roleClient) {
//            $sessions = Auth::user()->trainingSessions;
//            $coaches = Auth::user()->coaches;
//        }


        return view('sessions.create', [
            'sessions' => $sessions,
            'coaches' => $coaches
        ]);
    }

//    public function GetGymNameFromCityName(Request $request)
//    {
//        $city_id = $request->get('city_id');
//        $gyms = Gym::where('city_id', '=', $city_id)->get();
//        return response()->json($gyms);
//    }

//    public function GetCoachNameFromGymName(Request $request)
//    {
//        $coachs = Coach::all();
//        return response()->json($coachs);
//    }

    public function show($sessionID)
    {
        $session = TrainingSession::findOrFail($sessionID);
        return view('sessions.show', ['session' => $session]);
    }

    public function edit($id)
    {
        $session = TrainingSession::find($id);
//        $coaches = Coach::all();
        $roleAdmin = auth()->user()->hasRole('admin');
        $gender = auth()->user()->gender;

        if ($roleAdmin) {
            // Check the gender of the admin and filter users accordingly
            if ($gender === 'male') {
                $coaches = Coach::where('gender', 'male')->get();
            } elseif ($gender === 'female') {
                $coaches = Coach::where('gender', 'female')->get();
            }
        }

        return view('sessions.edit', [
            'session' => $session,
            'coaches' => $coaches
        ]);
    }

    public function update($id)
    {
        $formDAta = request()->all();

        $start = $formDAta['started_at'];
        $end = $formDAta['finished_at'];

//        $checkOverlap = $this->CheckOverlap($start, $end);

        if ($id) {
            $session = TrainingSession::find($id)->update($formDAta);

            return redirect()->route('sessions.index');
        } else {
            return Redirect::back()->withErrors(['msg' => 'time overlap ,choose another time']);
        }
    }


    public function destroy($id)
    {
        $session = TrainingSession::find($id);

        $checkSession = CoachSession::where('training_session_id', $id)->first();
        $checkAttendence = Attendance::where('training_session_id', $id)->first();

//        dd($checkAttendence);
        if ($checkAttendence == null) {

//            $session->gyms()->dissociate();
            $session->coaches()->detach();
            $session->delete();

            return to_route('sessions.index')
                ->with('success', 'sessions deleted successfully');
        } else {
            return redirect()->route('sessions.index')
                ->with('errorMessage', 'cannt be deleted');
        }
    }

    public function store(TrainingSessionRequest $request)
    {

        $start = $request['started_at'];
        $end = $request['finished_at'];
        $end = $request['finished_at'];
//        $coach = $request->coach_id;
        // $gym_id=$request['gym_id'];

//        $checkOverlap = $this->CheckOverlap($start, $end, $coach);

        if ($request->has('coach_id')) {
            $requestedData =
                [
                    // 'gym_id' => $request->gym_id,
                    'name' => $request->name,
                    'day' => $request->day,
                    'started_at' => $start,
                    'finished_at' => $end,
                ];

            $newSession = TrainingSession::create($requestedData);
            foreach ($request->coach_id as $coach) {
                CoachSession::create(
                    array(
                        'training_session_id' => $newSession['id'],
                        'coach_id' => $coach,
                    )
                );
            }
            return redirect()->route('sessions.index');
        } else {
            // return back()->with('error', 'Session date will Overlap another session, Choose different Date');
            return Redirect::back()->withErrors(['msg' => 'time overlap ,choose another time']);
        }
    }

//    public function getGymsBelongsToCity($id)
//    {
//        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
//    }

    // ========================> to retrieve data from database<=============================//

//    public function getSessionsCoachesAndGymsData()
//    {
//        $roleAdmin = auth()->user()->hasRole('admin');
//        $roleClient = auth()->user()->hasRole('client');
//
//        if ($roleAdmin) {
//            $sessions = TrainingSession::all();
//            $coaches = Coach::all();
//        } elseif ($roleClient) {
//            $sessions = Auth::user()->trainingSessions;
//            $coaches = Auth::user()->coaches;
//        }
//
//        return [$sessions, $coaches];
//    }


    // ========================> to check time overlap<=============================//
//    public function CheckOverlap($start, $end, $cosh)
//    {
//        // $sessions=TrainingSession::find($start)->trainingSessions;
//        $sessions = TrainingSession::find($cosh);
//        dd($sessions);
//
//
//        $start = date('Y-m-d H:i:s', strtotime($start));
//        $end = date('Y-m-d H:i:s', strtotime($end));
//        $errors = 0;
//        foreach ($sessions as $session) {
//            $oldStart = date('Y-m-d H:i:s', strtotime($session->started_at));
//            $oldEnd = date('Y-m-d H:i:s', strtotime($session->finished_at));
//            if (
//                ($this->betweenForStart($start, $oldStart, $oldEnd) ||
//                    $this->betweenForEdnd($end, $oldStart, $oldEnd))
//
//                ||
//                ($this->betweenForStart($oldStart, $start, $end)
//                    || $this->betweenForEdnd($oldEnd, $start, $end))
//            ) {
//                $errors++;
//            }
//        }
//        return $errors;
//    }

//    function betweenForStart($start, $oldstart, $oldend)
//    {
//        return $start >= $oldstart && $start < $oldend;
//    }

//    function betweenForEdnd($end, $oldstart, $oldend)
//    {
//        return $end > $oldstart && $end <= $oldend;
//    }
}
