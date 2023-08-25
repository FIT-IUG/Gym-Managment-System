<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingSessionRequest;
use App\Http\Requests\TrainingSessionRequest;
use App\Models\Attendance;
use App\Models\Attendee;
use App\Models\Coach;
use App\Models\CoachSession;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Period\PeriodCollections;

class TrainingSessionController extends Controller
{
    public function index()
    {

        $isWeb = auth()->guard('web')->check();
        if ($isWeb) {
            $roleAdmin = auth()->user()->hasRole('admin');
            $roleClient = auth()->user()->hasRole('client');
            $gender = auth()->user()->gender;
            if ($roleAdmin) {
                $sessions = TrainingSession::whereHas('coaches', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })->get();
                foreach ($sessions as $session) {
                    $daysFromDatabase = json_decode($session->days);
                    $daysArray = explode(",", $daysFromDatabase); // تقسيم النص إلى مصفوفة
                    $daysToShow = implode(", ", $daysArray);
                    $session->days = $daysToShow;
                }
                $coaches = Coach::where('gender', $gender)->get();
            } elseif ($roleClient) {
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
                $coachId = auth('coach')->user()->id;
                $coach = Coach::find($coachId);
                $sessions = $coach->trainingSessions;
                return view('sessions.index', [
                    'sessions' => $sessions,
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

    public function show($sessionID)
    {
        $isWeb = auth()->guard('web')->check();
        $isCoach = auth()->guard('coach')->check();
        if ($isWeb) {
            $gender = auth()->user()->gender;
        } else {
            $gender = auth('coach')->user()->gender;
        }
        $session = TrainingSession::findOrFail($sessionID);
        // $attendances = $session->attendances;
        // $attendances = Attendance::where('training_session_id', $sessionID)->get();
        $users = $session->users->filter(function ($user) use ($gender) {
            return $user->gender === $gender;
        });
        // dd($users);

        $daysFromDatabase = json_decode($session->days);
        $daysArray = explode(",", $daysFromDatabase); // تقسيم النص إلى مصفوفة
        $daysToShow = implode(", ", $daysArray);
        $session->days = $daysToShow;

        return view('sessions.show', ['session' => $session, 'users' => $users]);
    }
    public function attend(Request $request, $trainingSession)
    {
        // dd($request);
        $session = TrainingSession::findOrFail($trainingSession);
        // dd($session);

        foreach ($request->input('users') as $userId => $days) {
            foreach ($days as $day => $isChecked) {
                if ($isChecked === 'on') {
                    Attendee::where('user_id', $userId)->decrement('remaining_sessions');
                    $attendance = new Attendance();
                    $attendance->attendance_date = now();
                    $attendance->attendance_time = now();
                    $attendance->user_id = $userId;
                    $attendance->training_session_id = $session->id;
                    $attendance->save();
                    $user = User::find($userId);
                    $user->attendances()->save($attendance);
                }
            }
        }
        return redirect()->route('sessions.index');
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

        if ($checkAttendence == null) {

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
        $selectedDays = implode(',', $request->input('day'));
        //        dd($selectedDays);
        //        $coach = $request->coach_id;

        if ($request->has('coach_id')) {

            $newSession = new TrainingSession();
            $newSession->name = $request->input('name');
            $newSession->days = json_encode($selectedDays);
            $newSession->started_at = $start;
            $newSession->finished_at = $end;
            $newSession->save();
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
}
