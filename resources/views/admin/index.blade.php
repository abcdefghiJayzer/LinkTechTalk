@extends('components.main')

@include("admin.adminnavbar")

@section('content')

<section class="bg-neutral-800 h-screen m-0 ">

    <div class="flex h-full">

        @include("admin.sidebar")

        <main class="w-full p-2 ml-0 lg:ml-80 lg:mr-8 bg-neutral-850">

            <div class="py-3 flex justify-between items-center">
                <h2 class="text-3xl text-white font-semibold">Manage Posts</h2>

                <a href="{{route('admin.create')}}" class="btn sm bg-green-600 text-white rounded hover:bg-green-700 w-1/6 h-10 flex items-center justify-center text-center">
                    <h5>Add Post</h5>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-neutral-900 p-6 rounded-lg shadow-lg">
                <table class="min-w-full text-neutral-100">
                    <thead>
                        <tr class="text-left text-orange-500">
                            <th class="py-3 px-6">Title</th>
                            <th class="py-3 px-6">Category</th>
                            <th class="py-3 px-6 w-1/5">Action</th> <!-- Set width for Action column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr class="border-b border-neutral-700">
                            <!-- Title Column with Truncation -->
                            <td class="py-3 px-6" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 200px;">
                                {{ $post->title }}
                            </td>
                            <td class="class="py-3 px-6" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 200px;">
                                @if($post->category)
                                {{ $post->category->title }}
                                @else
                                No Category
                                @endif
                            </td>
                            <td class="py-3 px-6 w-1/5">
                                <div class="flex space-x-4 w-full justify-center">
                                    <a href="{{ route('admin.edit', ['admin' => $post->id]) }}"
                                        class="btn sm bg-orange-400 text-white rounded hover:bg-orange-500 flex-1 h-10 w-20 flex items-center justify-center text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.destroy', ['admin' => $post->id]) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn sm danger bg-red-500 text-white rounded hover:bg-red-700 h-10 w-20 flex items-center justify-center text-center">
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

        </main>
    </div>
</section>

@endsection
