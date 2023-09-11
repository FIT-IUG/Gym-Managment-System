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
        $authUser = Auth::user();
        $user = User::with('trainingSessions')->find($authUser->id);
        $sessions = $user->trainingSessions;
        $coaches = collect();

        foreach ($sessions as $session) {
            $coaches = $coaches->merge($session->coaches);
        }
        return view('gest.auth.clinteCoach', ['coaches' => $coaches]);
    }
    public function session()
    {
        $authUser = Auth::user();
        $user = User::with('trainingSessions')->find($authUser->id);
        $sessions = $user->trainingSessions;
        foreach ($sessions as $session) {
            $daysFromDatabase = json_decode($session->days);
            $daysArray = explode(",", $daysFromDatabase); // تقسيم النص إلى مصفوفة
            $daysToShow = implode(", ", $daysArray);
            $session->days = $daysToShow;
            //        dd($daysToShow);
        }
        return view('gest.auth.sessions', ['sessions' => $sessions,]);
    }
    public function parchedPackage()
    {
        $boughtPackageCollection = BuyPackage::where('user_id', auth()->user()->id)->get();
        return view('gest.auth.parchedPackage', ['boughtPackageCollection' => $boughtPackageCollection,]);
    }
}
