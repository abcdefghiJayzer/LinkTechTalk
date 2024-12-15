@extends('components.main')
@include("admin.adminnavbar")

@section('content')

<section class="bg-neutral-800 h-screen m-0">

    <div class="flex h-full">

        <!-- Sidebar -->
        @include("admin.sidebar")

        <!-- Main content area -->
        <main class="w-full ml-0 lg:ml-80 lg:mr-10 p-2 bg-neutral-850">
            <div class="py-3 flex justify-between items-center">
                <h2 class="text-3xl text-white font-semibold">Manage Categories</h2>

                <a href="{{ route('admin.addCategory') }}" class="btn sm bg-green-600 text-white rounded hover:bg-green-700 w-1/6 h-10 flex items-center justify-center text-center">
                    <h5>Add Category</h5>
                </a>
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

            <!-- Categories Table -->
            @if ($categories->count() > 0)
                <div class="overflow-x-auto bg-neutral-900 p-6 rounded-lg shadow-lg">
                    <table class="min-w-full text-neutral-100">
                        <thead>
                            <tr class="text-left text-orange-500">
                                <th class="py-3 px-6 text-left">Title</th>
                                <th class="py-3 px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-b border-neutral-700">
                                    <td class="py-3 px-2 text-white" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px;">
                                        {{ $category->title }}
                                    </td>
                                    <td class="py-3 px-2">
                                        <div class="flex space-x-4 justify-center">
                                            <a href="{{ route('admin.showEcategory', ['id' => $category->id]) }}"
                                               class="btn sm bg-orange-400 text-white rounded hover:bg-orange-500 flex-1 h-10 w-20 flex items-center justify-center text-center">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.deleteCategory', ['id' => $category->id]) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn sm danger bg-red-500 text-white rounded hover:bg-red-700 h-10 w-20 flex items-center justify-center text-center">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-red-500 text-white p-4 mb-4 rounded text-center">No categories found</div>
            @endif
        </main>
    </div>
</section>

@endsection
