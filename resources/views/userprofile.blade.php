@extends('layouts.user')
 
@section('title', 'Profile Settings')
 
@section('contents')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Profile
        </h1>
    </div>
</header>

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

<form action="{{ route('users.update', auth()->user()->id) }}" method="POST" class="max-w-md mx-auto p-6  rounded-lg border 300 shadow-md">
    @csrf
    
    <div class="block w-full text-sm "> 
        <h2 class="text-lg font-bold mb-4 text-center ">Admin Token</h2>
        <p class="text-sm mb-4">"Enter a valid admin token to gain admin access"</p>
        
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="type">Admin Token</label>
            <input type="text" name="type" id="type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2" required>
        </div>
        <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>

@endsection