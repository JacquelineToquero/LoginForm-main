@extends('layouts.app')
 
@section('title', 'Profile Settings')
 
@section('contents')
<form method="POST" enctype="multipart/form-data" action="" class="max-w-md mx-auto p-6 m-8 bg-white rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <h2 class="text-lg font-bold mb-4 text-center ">Profile</h2>
        <label class="block text-sm font-medium text-gray-700">
            Name
        </label>
        <input name="name" type="text" value="{{ auth()->user()->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2" required />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">
            Email
        </label>
        <input name="email" type="text" value="{{ auth()->user()->email }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2" required />
    </div>
    <div class="mt-6">
        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500 transition duration-200">
            Save Profile
        </button>
    </div>
</form>
@endsection