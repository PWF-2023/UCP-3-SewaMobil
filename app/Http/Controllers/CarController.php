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
            'license' => 'required|max:255'
        ]);
        Car::create([
            // 'user_id' => auth()->user()->id,
            'name' => $request->name,
            'brand' => $request->brand,
            'license' => $request->license
        ]);

        return redirect()->route('car.index')->with('success', 'Car created successfully!');
    }
}
