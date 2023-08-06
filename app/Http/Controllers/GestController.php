<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Coach;
use App\Models\Package;
use Illuminate\Http\Request;
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
//        $service = Package::where('id', $id)->get();
//        foreach ($service as $service) {
//            $service->description = Str::limit($service->description, 110);
//        }
        return view('gest.showService', ['service' => $service]);
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
}
