<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateCarClass extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('car.create');
    }
}
