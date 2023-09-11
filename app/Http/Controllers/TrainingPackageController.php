<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Support\Facades\Session;
use App\Models\BuyPackage;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class TrainingPackageController extends Controller
{
    /**
     * This function retrieves all training packages from the database and prepares them for display.
     */
    public function index()
    {
        $packageCollection = Package::all();
        return view('trainingPackages.index', ['packageCollection' => $packageCollection]);
    }

    public function trainingPackagesDatatables()
    {
        $packageCollection = Package::all();

        return view('trainingPackages.datatables-front', ['packageCollection' => $packageCollection]);
    }

    /**
     * This function is used to display the details of a specific training package.
     */
    public function show(Package $Package)
    {
        $id = $Package->id;
        $package_id = BuyPackage::find($id);
        return view('trainingPackages.show', ['package' => $Package, 'package_id' => $package_id]);
    }

    public function create()
    {
        return view('trainingPackages.create');
    }

    // public function store(StorePackageRequest $requestObj)
    /**
     * This function is responsible for storing a new training package in the database.
     */
    public function store(StorePackageRequest $request)
    {

        $image = $request->file('image');

        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'gym'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;
        $package = new Package();
        $package->name = $request->input('name');
        $package->price = $request->input('price');
        $package->image = $imageName;
        $package->description = $request->input('description');
        $package->save();
        return to_route('trainingPackages.index');
    }

    public function edit(Package $Package)
    {
        return view(
            'trainingPackages.edit',
            ['package' => $Package]
        );
    }

    /**
     * This function is responsible for updating an existing training package in the database.
     */
    public function update($package_id, StorePackageRequest $request)
    {
        $package = Package::findOrFail($package_id);

        $image = $request->file('image');

        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'gym'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        $package->name = $request->input('name');
        $package->price = $request->input('price');
        $package->image = $imageName;
        $package->description = $request->input('description');
        $package->save();
        return to_route('trainingPackages.show', ['package' => $package])
            ->with('success', 'Package Updated Successfully');
    }

    /**
     * This function is responsible for deleting a training package from the database.
     */
    public function destroy(Package $package)
    {
        $id = $package->id;
        $package_id = BuyPackage::where('package_id', $id)->first();

        if ($package_id == null) {
            $package->delete();
            return to_route('trainingPackages.index')
                ->with('success', 'package deleted successfully');
        } else {
            return redirect()->route('trainingPackages.index')
                ->with('errorMessage', 'cannt be deleted');
        }
    }
}
