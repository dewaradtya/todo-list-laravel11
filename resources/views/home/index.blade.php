@extends('layout.navbar')

@section('content')
    <main class="container mx-auto py-12">
        <div class="relative">
            <img class="rounded-md mt-2" src="https://placehold.co/1400x400" alt="Logo">
        </div>

        <div class="flex justify-center space-x-4 mt-4">
            <a href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white p-6 rounded-full hover:bg-blue-700 transition-colors duration-300"><i
                    class="fa-solid fa-list-check"></i></a>
            <a href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white p-6 rounded-full hover:bg-blue-700 transition-colors duration-300"><i
                    class="fa-solid fa-user-group"></i></a>
            <a href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white p-6 rounded-full hover:bg-blue-700 transition-colors duration-300"><i
                    class="fa-solid fa-list-check"></i></a>
        </div>
    </main>
@endsection
