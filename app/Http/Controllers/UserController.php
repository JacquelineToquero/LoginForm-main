<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userprofile()
    {
        return view('userprofile');
    }

    public function about()
    {
        return view('about');
    }

    public function index()
    {
        // Fetch all users
        $users = User::all();
        // Pass the users collection to the view
        return view('users.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID or fail
        return view('users.show', compact('user')); // Pass the user to the view
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID or fail
        return view('users.edit', compact('user')); // Pass the user to the edit view
    }

    public function update(Request $request, $id)
    {
        $product = User::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('user.index')->with('success', 'product updated successfully');
    }
    public function destroy($id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect with success message
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('user.index')->with('success', 'Product added successfully');
    }
}
