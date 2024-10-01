<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userprofile(User $user)
    {
        // $user = User::findOrFail($id);
        return view('userprofile', compact('user'));
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
        // Fetch the user by ID or fail
        return view('users.show', compact('user')); // Pass the user to the view
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID or fail
        return view('users.edit', compact('user')); // Pass the user to the edit view
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return redirect()->route('admin.home')->with('success', 'User updated successfully');
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
            'type' => "0" // Default user type
        ]);

        return redirect()->route('user.index')->with('success', 'User added successfully');
    }
}
