@extends('layouts.app')
 
@section('title', 'Profile Settings')
 
@section('contents')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-center mb-4">Profile Settings</h1>
    <hr class="mb-4" />
    <form method="POST" enctype="multipart/form-data" action="">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Name</label>
            <input name="name" type="text" value="{{ auth()->user()->name }}" id="name" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
            <input name="email" type="email" value="{{ auth()->user()->email }}" id="email" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" />
        </div>
        <div>
            <button type="submit" class="w-full bg-blue-500 text-white rounded-md p-2 hover:bg-blue-600 transition">Save Profile</button>
        </div>
    </form>
</div>
@endsection