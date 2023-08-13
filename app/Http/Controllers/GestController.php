<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BuyPackage;
use App\Models\Coach;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GestController extends Controller
{
    //
    public function home()
    {
        //        $coaches = Coach::all();
        $coaches = Coach::where('gender', 'male')->get();
        $services = Package::all();
        $blogs = Blog::all();
        foreach ($services as $service) {
            $service->description = Str::limit($service->description, 99);
        }
        return view('gest.home', ['coaches' => $coaches, 'services' => $services, 'blogs' => $blogs]);
    }

    public function service()
    {
        $services = Package::all();
        foreach ($services as $service) {
            $service->description = Str::limit($service->description, 110);
        }
        return view('gest.service', ['services' => $services]);
    }

    public function showService($id)
    {
        $service = Package::find($id);
        return view('gest.showService', ['service' => $service]);
    }
    public function showBlog($id)
    {
        $blog = Blog::find($id);
        return view('gest.showBlog', ['blog' => $blog]);
    }

    public function timeOfWork()
    {
        return view('gest.time_of_work');
    }

    public function pricing()
    {
        $packages = Package::all();
        return view('gest.pricing', ['packages' => $packages]);
    }

    public function blog()
    {
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            $blog->description = Str::limit($blog->description, 99);
        }
        return view('gest.blog', ['blogs' => $blogs]);
    }

    public function signinView()
    {
        return view('gest.login');
    }

    public function signupView()
    {
        return view('gest.joinUs');
    }
    public function myCoach()
    {
        $user = Auth::user();
        $attendance = User::with('attendances.trainingSessions')->find($user->id);
        $sessions = $attendance->attendances->pluck('trainingSessions');
        $coaches = collect();

        foreach ($sessions as $session) {
            $coaches = $coaches->merge($session->coaches);
        }
        return view('gest.auth.clinteCoach', ['coaches' => $coaches]);
    }
    public function session()
    {
        $user = Auth::user();
        $attendance = User::with('attendances.trainingSessions')->find($user->id);
        $sessions = $attendance->attendances->pluck('trainingSessions');
        return view('gest.auth.sessions', ['sessions' => $sessions,]);
    }
    public function parchedPackage()
    {
        $boughtPackageCollection = BuyPackage::where('user_id', auth()->user()->id)->get();
        return view('gest.auth.parchedPackage', ['boughtPackageCollection' => $boughtPackageCollection,]);
    }
}
