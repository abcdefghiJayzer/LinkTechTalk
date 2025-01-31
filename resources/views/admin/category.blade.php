@extends('components.main')
@include("admin.adminnavbar")
@section('content')

<section class="bg-neutral-800 h-screen m-0">

    <div class="flex h-full">

        @include("admin.sidebar")


        <main class="w-full p-10 ml-0 lg:ml-72 bg-neutral-850">
            <h2 class="text-3xl text-white mb-6 font-semibold">Add Category</h2>

            <form action="{{route('admin.storeCategory')}}" method="POST" class="space-y-6">
                @csrf

                <input
                    class="w-full p-2 rounded bg-neutral-600 text-white placeholder-neutral-200"
                    type="text"
                    name="title"
                    placeholder="Category"
                    required>

                <div class="flex justify-end space-x-4"> <!-- Flex container for side by side layout -->
                    <!-- Add Category Button -->
                    <button
                        type="submit"
                        name="submit"
                        class="w-full sm:w-1/2 lg:w-1/3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add
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
