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
    /**
     * This function is responsible for displaying a list of purchased packages,
     * typically used in an admin panel to track revenue and user purchases.
     */
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

    /**
     * This function is responsible for displaying detailed information about a purchased package,
     * typically used in an admin panel to view the details of a specific purchase.
     */
    public function show($boughtPackageID)
    {
        $boughtPackage = BuyPackage::findOrFail($boughtPackageID);
        return view('revenue.show', ['boughtPackage' => $boughtPackage]);
    }

    /**
     * This function is responsible for deleting a purchased package record,
     * usually used in an admin panel to remove a specific purchase from the system.
     */
    public function destroy($boughtPackageID)
    {
        BuyPackage::find($boughtPackageID)->delete();
        return redirect()->route('revenue.index');
    }
}
