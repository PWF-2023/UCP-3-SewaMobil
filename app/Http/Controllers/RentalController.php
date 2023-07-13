<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;

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

    // public function create()
    // {
    //     $categories = Car::where('user_id', auth()->user()->id)->get();
    //     return view('todo.create', compact('categories'));
    // }
    public function store(Request $request, Rental $rental)
    {
        $request->validate([
            'title' => 'required|max:255',
            'car_id' => [
                'nullable',
                Rule::exists('car', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
            ]
        ]);

        // Practical
        // $todo = new Todo;
        // $todo->title = $request->title;
        // $todo->user_id = auth()->user()->id;
        // $todo->save();


        // Query Builder way
        // DB::table('todos')->insert([
        //     'title' => $request->title,
        //     'user_id' => auth()->user()->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // Eloquent Way - Readable
        $rental = Rental::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id
        ]);
        // dd($todo);
        return redirect()->route('todo.index')->with('success', 'Todo created successfully!');
    }
    // public function edit(Todo $todo)
    // {
    //     $categories = Category::where('user_id', auth()->user()->id)->get();
    //     if (auth()->user()->id == $todo->user_id) {
    //         // dd($todo);
    //         return view('todo.edit', compact('todo', 'categories'));
    //     } else {
    //         // abort(403);
    //         // abort(403, 'Not authorized');
    //         return redirect()->route('todo.index')->with('danger','You are not authorized to edit this todo!');
    //     }
    // }

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

        // Practical
        // $todo->title = $request->title;
        // $todo->save();

        // Eloquent Way - Readable
        $rental->update([
            'title' => ucfirst($request->title),
            'car_id' => $request->car_id
        ]);
        return redirect()->route('rental.index')->with('success', 'Rent updated successfully!');
    }

    public function complete(Rental $rental)
    {
        if (auth()->user()->id == $rental->user_id) {
            $rental->update([
                'is_complete' => true,
            ]);
            return redirect()->route('rental.index')->with('success', 'Rent completed successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger','You are not authorized to complete this todo!');
        }
    }
    public function uncomplete(Rental $rental)
    {
        if (auth()->user()->id == $rental->user_id) {

            $rental->update([
                'is_complete' => false,
            ]);
            return redirect()->route('rental.index')->with('success', 'Rental uncompleted successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger','You are not authorized to uncomplete this todo!');
        }
    }
    public function destroy(Rental $rental)
    {
        if (auth()->user()->id == $rental->user_id) {
            $rental->delete();
            return redirect()->route('rental.index')->with('success', 'Rental deleted successfully!');
        } else {
            return redirect()->route('rental.index')->with('danger','You are not authorized to delete this todo!');
        }
    }
    public function destroyCompleted()
    {
        // get all todos for current user where is_completed is true
        $rentalsCompleted = Rental::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($rentalsCompleted as $rental) {
            $rental->delete();
        }
        // dd($todosCompleted);
        return redirect()->route('rental.index')->with('success', 'All completed todos deleted successfully!');
    }
}
