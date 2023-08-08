<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Nette\Utils\Paginator;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index()
    {

        $roleAdmin = auth()->user()->hasRole('admin');
        $gender = auth()->user()->gender;

        if ($roleAdmin) {
            if ($gender === 'male') {
                $attendances = Attendance::whereHas('users', function ($query) {
                    $query->where('gender', 'male');
                })->get();
            } elseif ($gender === 'female') {
                $attendances = Attendance::whereHas('users', function ($query) {
                    $query->where('gender', 'female');
                })->get();
            }
        } else {
            $attendances = Auth::user()->attendances;
        }

        return view('attendance.index', [
                'attendances' => $attendances,
            ]
        );
    }
}
