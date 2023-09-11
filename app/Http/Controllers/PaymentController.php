<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BuyPackage;
use App\Models\Package;
use App\Models\TrainingSession;
use App\Models\User;
use App\Models\user_sessions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * This store function is responsible for creating a new purchase of a training package and updating the user's training sessions.
     */
    public function store(Request $requestObj)
    {
        $requestData = $requestObj->all();
        $package = DB::table('training_packages')->where('id', $requestObj->get('package_id'))->first();
        $user_id = $requestObj->user_id;
        $package_id = $requestObj->package_id;
        $session_id = $requestObj->session_id;

        if ($user_id == null || $package_id == null) {
            return Redirect::back()->withErrors(['message' => 'complete your data']);
        } else {

            BuyPackage::create([
                'price' => $package->price,
                'number_of_sessions' => 35,
                'remaining_sessions' => 30,
                'package_id' => $package_id,
                'name' => $package->name,
                'user_id' => $user_id,

            ]);
            user_sessions::create([
                "training_session_id" => $session_id,
                "user_id" => $user_id,
            ]);
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
