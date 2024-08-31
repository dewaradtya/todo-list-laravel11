<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do List</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="bg-gray-800 text-white p-4">
        <div class="flex items-center justify-between">
            <a href="#" class="flex items-center">
                <img src="logo.png" alt="Logo" class="h-10 w-10 rounded-full ml-3">
            </a>

            <div class="flex-1 ml-6">
                <form method="GET" action="{{ route('posts.index') }}">
                    @if (!request()->is('trash') && !request()->is('posts/*/edit'))
                        <div class="flex justify-start">
                            <input type="search" name="search" placeholder="Search" value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 rounded-full bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600">
                                Search
                            </button>
                        </div>
                    @endif
                </form>
            </div>

            <!-- User Actions -->
            <div class="hidden lg:flex items-center">
                <ul class="flex items-center">
                    <li class="nav-item">
                        <span class="text-white mt-2">Hi, {{ auth()->user()->name }}</span>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm text-blue-500 border border-blue-500 rounded-full hover:bg-blue-500 hover:text-white">
                                Sign In
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item ml-2">
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-sm text-red-500 border border-red-500 rounded-full hover:bg-red-500 hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</body>

</html>
