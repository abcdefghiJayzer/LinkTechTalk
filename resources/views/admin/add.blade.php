@extends('components.main')

@section('content')

<section class="bg-neutral-800 h-screen m-0">

    <div class="flex h-full">

        <!-- Sidebar -->
        @include("admin.sidebar")

        <!-- Main content area -->
        <main class="w-full ml-0 lg:ml-72 p-10 bg-neutral-850">

            <!-- Page Title and Button -->
            <div class="py-3 flex justify-between items-center">
                <h2 class="text-3xl text-white font-semibold">Add Post</h2>
            </div>

            <!-- Flash messages for success or error -->
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

            <!-- Form for adding a post -->
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="">
                    <input type="file" name="image" id="image" accept="image/*" class="w-full p-1 rounded bg-neutral-600 text-white placeholder-neutral-200" />
                </div>

                <input class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200" type="text" name="title" placeholder="Title" required>

                <select name="category" required class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200">
                    <option value="">Select Category</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>

                <textarea rows="1" name="body" id="content" placeholder="Body" required class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200"></textarea>




                <div class="flex justify-end space-x-4">
                    <button
                        type="submit"
                        name="submit"
                        class="w-full sm:w-1/2 lg:w-1/3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add
                    </button>

                    <!-- Cancel Link -->
                    <a href="{{route('admin.index')}}" class="w-full sm:w-1/2 lg:w-1/3 text-white font-bold py-2 px-4 rounded bg-red-600 hover:bg-red-700 h-10 flex items-center justify-center text-center">
                        <h5>Cancel</h5>
                    </a>
                </div>
            </form>

        </main>
    </div>
</section>

@endsection
