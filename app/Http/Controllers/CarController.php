<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('user')->paginate(10);

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'required',
            'banner_image' => 'required',
            'price' => 'required',
            'user_id' => 'required|exists:App\Models\User,id',
        ]);

        $nomFichier = basename($request->file('banner_image')->store('public/images'));

        $car = new Car();
        $car->name = $request->input("name");
        $car->description = $request->input("description");
        $car->price = $request->input("price");
        $car->banner_image = "storage/images/" . $nomFichier;
        $car->user_id = $request->input("user_id");

        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        return view('cars.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.$request->file('banner_image')->store('public/images');
     */
    public function update(Request $request, Car $car)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'required|exists:App\Models\User,id',
        ]);

        if($request->hasFile('banner_image')) {
            $nomFichier = basename($request->file('banner_image')->store('public/images'));
            $car->banner_image = "storage/images/" . $nomFichier;
        }

        $car->name = $request->input("name");
        $car->description = $request->input("description");
        $car->price = $request->input("price");
        $car->user_id = $request->input("user_id");

        $car->update();

        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        Gate::allowIf(auth()->user() && auth()->user()->role == 1);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
}
