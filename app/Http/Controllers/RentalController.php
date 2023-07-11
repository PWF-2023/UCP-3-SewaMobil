<?php

namespace App\Http\Controllers;

use App\Models\Rental;

use Illuminate\Http\Request;

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
}
