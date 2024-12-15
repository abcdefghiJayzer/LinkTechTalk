@extends('components.main')
@include("admin.adminnavbar")
@section('content')

<section class="bg-neutral-800 h-screen m-0">

    <div class="flex h-full">

        @include("admin.sidebar")

        @if (session('success'))
        <div class="flash-message success bg-green-500 text-white p-4 mb-4 rounded flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button class="close-button text-white" onclick="closeFlashMessage()">&times;</button>
        </div>
        @endif

        @if (session('error'))
        <div class="flash-message error bg-red-500 text-white p-4 mb-4 rounded flex justify-between items-center">
            <span>{{ session('error') }}</span>
            <button class="close-button text-white" onclick="closeFlashMessage()">&times;</button>
        </div>
        @endif

        <main class="w-full p-10 ml-0 lg:ml-72 bg-neutral-850">
            <h2 class="text-3xl text-white mb-6 font-semibold">Edit Category</h2>

            <form action="{{route('admin.updateCategory', ['id' => $categories->id])}}" method="POST" class="space-y-6">
                @csrf
                @METHOD('PUT')

                <input
                    class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200"
                    type="text"
                    name="title"
                    value="{{$categories->title}}"
                    placeholder="Title"
                    required>

                <div class="flex justify-end space-x-4"> <!-- Flex container for side by side layout -->
                    <!-- Update Category Button -->
                    <button
                        type="submit"
                        name="submit"
                        class="w-full sm:w-1/2 lg:w-1/3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>

                    <!-- Cancel Link -->
                    <a href="{{route('admin.showCategory')}}" class="w-full sm:w-1/2 lg:w-1/3 text-white font-bold py-2 px-4 rounded bg-red-600 hover:bg-red-700 h-10 flex items-center justify-center text-center">
                        <h5>Cancel</h5>
                    </a>
                </div>
            </form>

        </main>
    </div>
</section>

@endsection
