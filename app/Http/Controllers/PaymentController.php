<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BuyPackage;
use App\Models\Package;
use App\Models\TrainingSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function store(Request $requestObj)
    {
//        dd($requestObj);
        $requestData = $requestObj->all();
        $package = DB::table('training_packages')->where('id', $requestObj->get('package_id'))->first();
        $packageName = $package->name;
        $trainingSession = TrainingSession::where('name', $packageName)->first();
        if (!$trainingSession) {
            return response()->json(['error' => 'Invalid training session Name'], 400);
        }
//        dd($trainingSession);
        $user_id = $requestObj->user_id;
        $package_id = $requestObj->package_id;
//        dd($package->training_session_id);
//        DB::table('users')->where('id', $user_id)->update(['gym_id' => $gym_id]);

        if ($user_id == null || $package_id == null) {
            return Redirect::back()->withErrors(['message' => 'complete your data']);
        } else {

            BuyPackage::create([
                'price' => $package->price,
                'package_id' => $package_id,
                'name' => $package->name,
                'user_id' => $user_id,

            ]);
            $startAt = Carbon::parse($trainingSession->start_at);
            $attendance = new Attendance();
            $attendance->attendance_date = $startAt->toDateString(); // Replace with the actual attendance date
            $attendance->attendance_time = $startAt->toTimeString(); // Replace with the actual attendance time
            $attendance->user_id = $requestObj->user_id;
            $attendance->training_session_id = $trainingSession->id;
            $attendance->save();
            $user = User::find($requestObj->user_id);
            $user->attendances()->save($attendance);
            return to_route('buyPackage.index');
        }


    }

    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        DB::table('stripe')->delete();
        return to_route('buyPackage.index');
    }
}
