<?php

namespace App\Http\Controllers;

use App\Models\Car;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('rental');
        return view('car.index', compact('cars'));
    }

    public function create()
    {
        return view('car.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'type' => 'required|max:255',
            'license' => 'required|max:255',
            'price' => 'required|max:255',
            // 'ready' => 'required|max:255',
        ]);
        Car::create([
            // 'user_id' => auth()->user()->id,
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'license' => $request->license,
            'price' => $request->price,
            // 'ready' => $request->ready,
        ]);

        return redirect()->route('car.index')->with('success', 'Car created successfully!');
    }

    public function edit(Car $car)
    {
        if (auth()->user()->id == $car->user_id) {
            return view('car.edit', compact('car'));
        } else {
            return redirect()->route('car.index')->with('error', 'You are not authorized to edit this car!');
        }
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'type' => 'required|max:255',
            'license' => 'required|max:255',
            'price' => 'required|max:255',
            // 'ready' => 'required|max:255',
        ]);
        $car->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'license' => $request->license,
            'price' => $request->price,
            // 'ready' => $request->ready,
        ]);

        return redirect()->route('car.index')->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        if (auth()->user()->id == $car->user_id) {
            $car->delete();
            return redirect()->route('car.index')->with('success', 'Car deleted successfully!');
        } else {
            return redirect()->route('car.index')->with('error', 'You are not authorized to delete this car!');
        }
    }

    public function ready(Car $car)
    {
        if (auth()->user()->id == $car->user_id) {
            $car->update([
                'ready' => true,
            ]);
            return redirect()->route('car.index')->with('success', 'Car is ready!');
        } else {
            return redirect()->route('car.index')->with('error', 'You are not authorized to edit this car!');
        }
    }

    public function notReady(Car $car)
    {
        if (auth()->user()->id == $car->user_id) {
            $car->update([
                'ready' => false,
            ]);
            return redirect()->route('car.index')->with('success', 'Car is not ready!');
        } else {
            return redirect()->route('car.index')->with('error', 'You are not authorized to edit this car!');
        }
    }
}
