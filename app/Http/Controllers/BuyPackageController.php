<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\City;
use App\Models\BuyPackage;
use App\Models\CityManager;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\Package;
use App\Models\Stripe;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class BuyPackageController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $boughtPackageCollection = BuyPackage::paginate(10);
        $isAdmin = auth()->user()->hasRole('admin');
        $gender = auth()->user()->gender;

        if ($isAdmin) {
            if ($gender === 'male') {
                $boughtPackageCollection = BuyPackage::whereHas('user', function ($query) {
                    $query->where('gender', 'male');
                })->paginate(10);
            } elseif ($gender === 'female') {
                $boughtPackageCollection = BuyPackage::whereHas('user', function ($query) {
                    $query->where('gender', 'female');
                })->paginate(10);
            }
        } else {
            $boughtPackageCollection = BuyPackage::where('user_id', auth()->user()->id)->get();
        }
        return view('buyPackage.index', ['boughtPackageCollection' => $boughtPackageCollection]);
    }

    public function show(BuyPackage $Package)
    {

        return view('buyPackage.show', ['package' => $Package]);
    }

    public function destroy(BuyPackage $package)
    {
        $package->delete();

        return to_route('buyPackage.index')
            ->with('success', 'package deleted successfully');
    }

    public function create()
    {
        $packages = DB::table('training_packages')->get();
        $users = User::Role('client')->get();
        $roleAdmin = Auth::user()->hasRole('admin');
        $roleClient = Auth::user()->hasRole('client');

        $loggedInUser = Auth::user();
//        $user = User::role('cityManager')->get()->where('id', $loggedInUser->id)->where('city_id', $loggedInUser->city_id);
        $gender = auth()->user()->gender;
        if ($roleAdmin) {
            if ($gender === 'male') {
                $users = User::role('client')->where('gender', 'male')->get();
            } elseif ($gender === 'female') {
                $users = User::role('client')->where('gender', 'female')->get();
            }
            return view('payment.create', data: [
                'packages' => $packages,
                'users' => $users,
            ]);
        } else {
            $user_id = $loggedInUser->id;
            return view('payment.create', data: [
                'packages' => $packages,
                'users' => $user_id,
            ]);
        }

        return view('payment.create', data: [
//            'cities' => $city_id,
            'packages' => $packages,
            'users' => $users,
//            'gyms' => $gym_id,
        ]);
    }


    public function store(Request $requestObj)
    {
//        dd($requestObj);
//        $paymentData = Stripe::first();

        $package = DB::table('training_packages')->where('id', $requestObj->package_id)->first();
        dd($package->training_session_id);
        BuyPackage::create([
            'price' => ($package->price),
            'package_id' => $requestObj->package_id,
            'name' => $requestObj->name,
            'user_id' => $requestObj->user_id,
        ]);
        $attendance = new Attendance();
        $attendance->attendance_date = date('Y-m-d');
        $attendance->attendance_time = date('H:i:s');
        $attendance->user_id = $requestObj->user_id;
        $attendance->training_session_id = $package->training_session_id;

        $user = User::find($requestObj->user_id);
        $trainingSession = TrainingSession::find($package->training_session_id);
        $user->attendances()->save($attendance);
        $trainingSession->attendances()->save($attendance);

        $attendance->save();
        DB::table('stripe')->delete();

        return to_route('buyPackage.index');
    }

}
