<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuyPackage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Yajra\DataTables\Facades\DataTables;

class RevenueController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->hasRole('admin');
        $gender = auth()->user()->gender;

        if ($isAdmin) {
            if ($gender === 'male') {
                //                $boughtPackages = BuyPackage::all();
                $boughtPackages = BuyPackage::whereHas('user', function ($query) {
                    $query->where('gender', 'male');
                })->paginate(10);
            } elseif ($gender === 'female') {
                $boughtPackages = BuyPackage::whereHas('user', function ($query) {
                    $query->where('gender', 'female');
                })->paginate(10);
            }
        }

        return view('revenue.index', data: [
            'boughtPackages' => $boughtPackages,
        ]);
    }

    public function show($boughtPackageID)
    {
        $boughtPackage = BuyPackage::findOrFail($boughtPackageID);
        return view('revenue.show', ['boughtPackage' => $boughtPackage]);
    }

    public function destroy($boughtPackageID)
    {
        BuyPackage::find($boughtPackageID)->delete();
        return redirect()->route('revenue.index');
    }
}
