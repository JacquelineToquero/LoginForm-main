@extends('layouts.app')
 
@section('title', 'Edit Product')
 
@section('contents')
<h1 class="mb-0">Edit Product</h1>
<hr />
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="title" value="{{ $user->name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
 
            <div class="sm:col-span-4 py-">
                <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input id="price" name="email" type="text" value="{{ $user->email }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input id="product_code" name="password" value="{{ $user->password }}" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            
            <div class="mt-2">
                <fieldset class="block w-full">
                    <legend class="block text-sm font-medium leading-6 text-gray-900">User Type</legend>
                    <div class="flex items-center">
                        <input type="radio" name="type" value="1" class="mr-2" {{ $user->type }}>
                        <label for="admin" class="text-gray-900">Admin</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="type" value="0" class="mr-2" {{ $user->type }}>
                        <label for="user" class="text-gray-900">User</label>
                    </div>
                </fieldset>
            </div>

            <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </form>
    </div>
</div>
@endsection