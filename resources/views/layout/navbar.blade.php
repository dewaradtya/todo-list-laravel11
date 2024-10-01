<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do List</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="bg-gray-900 text-white p-4">
        <div class="flex items-center justify-between">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full ml-3">
            </a>

            <div class="flex-1 ml-6">
                <form method="GET" action="{{ route('posts.index') }}">
                    @if (!request()->is('trash') && !request()->is('posts/*/edit'))
                        <div class="flex justify-start">
                            <input type="search" name="search" placeholder="Search" value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 rounded-full bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-gray-200 text-black rounded-full hover:bg-gray-400">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    @endif
                </form>
            </div>
            <div class="flex-1">
                <ul class="flex space-x-6">
                    <li>
                        <a href="/" class="text-white hover:text-gray-400">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="text-white hover:text-gray-400">Tasks</a>
                    </li>
                    <li>
                        <a href="{{ route('group.index') }}" class="text-white hover:text-gray-400">Group</a>
                    </li>
                </ul>
            </div>

            <!-- User Actions -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <a href="{{ route('profile.show') }}" class="text-white hover:text-gray-400">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-400">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm text-blue-500 border border-blue-500 rounded-full hover:bg-blue-500 hover:text-white">
                        Sign In
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="fixed top-4 right-4 z-50">
        @if (session('success'))
            <div  id="flash-success" class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 rounded shadow-md" role="alert">
                <i class="fa-regular fa-circle-check mr-2"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif
    
        @if (session('error'))
            <div id="flash-error" class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3 rounded shadow-md" role="alert">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>
    

    @yield('content')
</body>
<script>
    // Function to hide the flash message after a delay
    function hideFlashMessage(id, delay) {
        setTimeout(() => {
            const flashMessage = document.getElementById(id);
            if (flashMessage) {
                flashMessage.style.transition = "opacity 1s ease-out";
                flashMessage.style.opacity = "0";
                setTimeout(() => flashMessage.remove(), 1000); // Remove after fade-out
            }
        }, delay);
    }

    // Automatically hide flash messages after 5 seconds (5000 ms)
    hideFlashMessage('flash-success', 5000);
    hideFlashMessage('flash-error', 5000);
</script>
</html>
