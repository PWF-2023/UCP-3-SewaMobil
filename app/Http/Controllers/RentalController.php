<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('car')
            ->orderBy('created_at', 'asc')
            ->orderBy('is_completed', 'desc')
            ->get();
        $rentalsCompleted = Rental::with('car')
            ->where('is_completed', 1)
            ->count();
        return view('rental.index', compact('rentals', 'rentalsCompleted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'car_id' => 'exists:cars',
            'duration' => 'required|integer',
            'total_price' => 'required|integer',
            'is_completed' => 'required|max:255',
        ]);

        Rental::create([
            'user_id' => auth()->user()->id,
            'car_id' => $request->car_id,
            'duration' => $request->duration,
            'total_price' => $request->total_price,
            'is_completed' => $request->is_completed,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'title' => 'required|max:255',
            'car_id' => [
                'nullable',
                Rule::exists('cars', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
            ]
        ]);

        $rental->update([
            'title' => ucfirst($request->title),
            'car_id' => $request->car_id
        ]);

        return redirect()->route('rental.index')->with('success', 'Rent updated successfully!');
    }

    public function complete(Rental $rental, User $users)
    {
        if (auth()->user()->id == $users->is_admin = true) {
            $rental->update([
                'is_completed' => 1,
            ]);
            return redirect()->route('rental.index')->with('success', 'Rental completed successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger', 'You are not authorized to complete this rental!');
        }
    }

    public function uncomplete(Rental $rental, User $users)
    {
        if (auth()->user()->id == $users->is_admin = true) {
            $rental->update([
                'is_completed' => 0,
            ]);
            return redirect()->route('rental.index')->with('success', 'Rental uncompleted successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger', 'You are not authorized to uncomplete this rental!');
        }
    }




    public function destroy(Rental $rental, User $users)
    {
        if (auth()->user()->id == $users->is_admin = true) {
            $rental->delete();
            return redirect()->route('rental.index')->with('success', 'Rental deleted successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger', 'You are not authorized to delete this rental!');
        }
    }

    public function destroyCompleted()
    {
        $rentalsCompleted = Rental::where('user_id', auth()->user()->id)
            ->where('is_completed', true)
            ->get();
        foreach ($rentalsCompleted as $rental) {
            $rental->delete();
        }

        return redirect()->route('rental.index')->with('success', 'All completed rentals deleted successfully!');
    }
}
