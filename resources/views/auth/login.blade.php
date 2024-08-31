<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <main class="mt-0">
        <section>
            <div class="min-h-screen bg-gradient-to-br from-blue-600 to-blue-900 flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <div class="mb-4">
                            <h4 class="text-2xl font-bold">Sign In</h4>
                            <p class="text-gray-600">Enter your email and password to sign in</p>
                        </div>
                        @if (session('Error'))
                            <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                                {{ session('Error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Email" aria-label="Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Password" aria-label="Password">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Sign
                                    In</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <a href="{{ route('register') }}">Don't have an
                                account? <span class="text-blue-500 hover:underline">Sign up</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
