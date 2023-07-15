<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $search = request('search');
        // if($search){
        //     $rentals = Rental::with('car')
        //         // ->where('user_id', auth()->user()->id)
        //         ->where(function ($query) use ($search){

        //             $query->where('', 'like', '%' . $search . '%');
        //         })
        //         ->latest()
        //         ->get();

        //         return response()->json([
        //             'status' => 'success',
        //             'data' => [
        //                 'rentals' => $rentals,
        //                 ]
        //         ],200);
        // }


        $rentals = Rental::with('car')
        // ->where('user_id', auth()->user()->id)
        ->latest()
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'rentals' => $rentals,
                ]
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
        $rental = Rental::with('car')
        ->where('id', $rental->id)
        ->first();
        if ($rental->user_id != auth()->user()->id){
            return response()->json([
                'status' => 'error',
                'message' => 'forbidden'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'rental' => $rental,
                ]
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
