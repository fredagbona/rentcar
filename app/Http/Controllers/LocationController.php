<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::with(['user', 'car'])->paginate(10);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::allowIf(auth()->user());
        return view('locations.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(auth()->user());
        $request->validate([
            'date' => 'required',
            'user_id' => 'required|exists:App\Models\User,id',
            'car_id' => 'required|exists:App\Models\Car,id',
        ]);

        $car = Car::find($request->input("car_id"));
        $location = new Location();
        $location->date = $request->input("date");
        $location->price = $request->input("date") * $car->price;
        $location->user_id = $request->input("user_id");

        $location->save();

        $location->car()->save($car);

        $car->status = false;

        $car->update();


        return redirect()->route('location.index')->with('success', 'Location added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        $locations = Location::with('car')->where('user_id', auth()->user()->id)->paginate(10);
        return view('locations.show', compact('locations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        return view('location.edit', ['location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        $request->validate([
            'start' => 'required',
            'end' => 'required',
            'user_id' => 'required|exists:App\Models\User,id',
        ]);

        $location->start = $request->input("start");
        $location->end = $request->input("end");
        $location->user_id = $request->input("user_id");

        $location->update();

        if (!empty($request->car_id)) {
            $car = Car::find($request->input("car_id"));
            $oldcar = $location->car;
            $oldcar->status = true;
            $location->car()->save($car);
        }



        return redirect()->route('location.index')->with('success', 'Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        Gate::allowIf(auth()->user());
        $location->car->status = true;
        $location->car->update();
        $location->car()->update(['location_id' => null]); // remove the profile association
        $location->delete();
        
        return redirect()->route('location.index')->with('success', 'Location deleted successfully');
    }
}
