<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Blog;
use App\Models\BuyPackage;
use App\Models\Coach;
use App\Models\CoachSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\GymManager;
use App\Models\Package;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        dd(auth()->user());
        $packages = Package::all();
        $isCoach = auth()->guard('coach')->check();
//        dd(auth()->user()->Role('admin'));
        $isAdmin = auth()->user()->hasRole('admin');
//        $isCoach = auth('coach')->user()->hasRole('coach');
//        $isGymManager = auth()->user()->hasRole('gymManager');
        $isClient = auth()->user()->hasRole('client');

        if (!$isClient && !$isCoach) {
            if ($isAdmin) {
                $boughtPackages = BuyPackage::all();
                $boughtPackagesCount = count($boughtPackages);
                $allClients = User::role('client')->get();
            }

            $paidPrice = ($boughtPackages->sum('price') / 100);
            $allClientsCount = count($allClients);

            return view('dashboard', data: [
                'packages' => $packages,
                'boughtPackages' => $boughtPackages,
                'boughtPackagesCount' => $boughtPackagesCount,
                'allClientsCount' => $allClientsCount,
                'paidPrice' => $paidPrice,
            ]);
        } elseif ($isCoach) {
            return view('dashboard', data: [
//                'packages' => $packages,
//                'boughtPackages' => $boughtPackages,
//                'boughtPackagesCount' => $boughtPackagesCount,
//                'allClientsCount' => $allClientsCount,
//                'paidPrice' => $paidPrice,
            ]);
        } else {
            $attendances = Attendance::where('user_id', auth()->user()->id)->get();
            $boughtPackages = BuyPackage::where('user_id', auth()->user()->id)->get();
            $coaches = Coach::all();
            $services = Package::all();
            $blogs = Blog::all();
            foreach ($services as $service) {
                $service->description = Str::limit($service->description, 99);
            }
            return view('dashboard', data: [
                'boughtPackages' => $boughtPackages,
                'attendances' => $attendances,
                'services' => $services,
                'coaches' => $coaches,
                'blogs' => $blogs,
            ]);
        }
    }

    public function indexCoach()
    {
//        dd(auth()->user());
//        $packages = Package::all();
        $isCoach = auth()->guard('coach')->check();
//        dd(auth()->user()->Role('admin'));
        $isCoach = auth('coach')->user()->hasRole('coach');

        if ($isCoach) {
            $coachId = auth('coach')->user()->id;
            $coach = Coach::find($coachId);
            $trainingSessions = $coach->trainingSessions;
//            dd($trainingSessions);
//                $sessions = Coach::with('trainingSessions')->where('id', auth()->user()->id)->get();
            return view('dashboard', data: [
                'trainingSessions' => $trainingSessions,
//                'boughtPackages' => $boughtPackages,
//                'boughtPackagesCount' => $boughtPackagesCount,
//                'allClientsCount' => $allClientsCount,
//                'paidPrice' => $paidPrice,
            ]);
        } else {
            $attendances = Attendance::where('user_id', auth()->user()->id)->get();
            $boughtPackages = BuyPackage::where('user_id', auth()->user()->id)->get();
            $coaches = Coach::all();
            $services = Package::all();
            $blogs = Blog::all();
            foreach ($services as $service) {
                $service->description = Str::limit($service->description, 99);
            }
            return view('dashboard', data: [
                'boughtPackages' => $boughtPackages,
                'attendances' => $attendances,
                'services' => $services,
                'coaches' => $coaches,
                'blogs' => $blogs,
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $user->date_of_birth = \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d');
        $user->date_of_birth = new \DateTime($user->date_of_birth);
        $currentDate = new \DateTime();
        $ageInterval = $user->date_of_birth->diff($currentDate);
        $age = $ageInterval->y;
        $msg = 0;
        return view('gest.auth.profile', ['user' => $user, 'age' => $age, "msg" => $msg]);
    }
}
