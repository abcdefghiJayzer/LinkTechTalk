@extends('components.main')

@section('content')

<section class="bg-neutral-800 h-screen m-0">

    <div class="flex h-full">

        <!-- Sidebar -->
        @include("admin.sidebar")

        <!-- Main content area -->
        <main class="w-full ml-0 lg:ml-72 p-10 bg-neutral-850 ">

            <!-- Page Title -->
            <div class="py-3 flex justify-between items-center">
                <h2 class="text-3xl text-white font-semibold">Edit Post</h2>
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

            <!-- Form for updating the post -->
            <form action="{{ route('admin.update', ['admin' => $posts->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    @if ($posts->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$posts->image) }}" alt="Post Image" class="w-full h-60 object-cover rounded mb-2">
                    </div>
                    @endif


                    <input type="file" name="image" id="image" accept="image/*" class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200">

                </div>

                <!-- Title Input -->
                <input class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200 mb-4"
                    type="text" name="title" value="{{ $posts->title }}" placeholder="Title" required>

                <!-- Category Select -->
                <select name="category" required class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200 mb-4">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $posts->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                    @endforeach
                </select>

                <!-- Body Textarea -->
                <textarea rows="6" name="body" id="updatecontent" placeholder="Body" required class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200 mb-4">{{ $posts->body }}</textarea>

                <!-- Image Upload -->


                <div class="flex justify-end space-x-4 pb-20"> <!-- Flex container for side by side layout -->
                    <!-- Update Category Button -->
                    <button
                        type="submit"
                        name="submit"
                        class="w-full sm:w-1/2 lg:w-1/3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Edit Post
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
