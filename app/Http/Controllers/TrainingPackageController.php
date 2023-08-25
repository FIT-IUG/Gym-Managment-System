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
    public function store(StorePackageRequest $request)
    {
        // dd($request);
        // Package::create([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'description' => $request->number_of_sessions,

        // ]);
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

    public function update($package_id, StorePackageRequest $request)
    {
        $package = Package::findOrFail($package_id);
//        $package->update([
//            'price' => $request->price,
//            'number_of_sessions' => $request->number_of_sessions,
//        ]);
        $image = $request->file('image');

//        dd($image);
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
