

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
</head>
 
<body class="pt-10 bg-blue-100">
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-6">Reset Password</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
    
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" />
                @error('email')
                    <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" id="password" name="password" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" />
                @error('password')
                    <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" />
            </div>
    
            <button type="submit" class="w-full bg-blue-500 text-white rounded-md p-2 hover:bg-blue-600 transition">Reset Password</button>
        </form>
    </div>
</body>
 
</html>
