<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingSessionRequest;
use App\Http\Requests\TrainingSessionRequest;
use App\Models\Attendance;
use App\Models\Coach;
use App\Models\CoachSession;
use App\Models\TrainingSession;
use App\Models\User;
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
            if ($roleAdmin) {
                $sessions = TrainingSession::all();
                foreach ($sessions as $session) {
                    $daysFromDatabase = json_decode($session->days);
                    $daysArray = explode(",", $daysFromDatabase); // تقسيم النص إلى مصفوفة
                    $daysToShow = implode(", ", $daysArray);
                    $session->days = $daysToShow;
                }
                $coaches = Coach::all();
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
