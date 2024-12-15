@extends('components.main')

@include('includes.navbar')

@section('content')

@include("includes.hero")

<section class="max-w-screen-lg mx-auto">
    <h1 class="text-center font-bold text-white text-3xl p-10 mt-4 uppercase">
        Blogs
    </h1>


    <form action="javascript:void(0);" method="GET">

        <div class="flex flex-col md:flex-row items-center justify-end space-y-2 md:space-y-0 w-full overflow-x-hidden px-5 md:px-0">

            <div class="flex flex-col md:flex-row md:items-center w-full">
                <select class="bg-neutral-800 text-white border border-neutral-700 rounded p-3 md:mx-2 w-full md:w-auto" id="categoryFilter" name="category">
                    <option class="pr-4" value="">Sort By Category</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach

                </select>
            </div>

            <div class="flex flex-col md:flex-row md:items-center w-full">
                <i class="hidden md:block uil uil-search w-full"></i>
                <input class="bg-neutral-800 text-white border border-neutral-700 rounded p-3 md:mx-2 w-full md:w-auto" type="search" id="searchInput" name="search" placeholder="Search" autocomplete="off">
            </div>
        </div>
    </form>


</section>

<section class="posts">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 mx-auto max-w-screen-lg" id="postsContainer">
        @foreach ($posts as $post)

        <div class="p-4 bg-neutral-900 max-w-xs shadow rounded-xl mx-auto">

            <div>
                <img class="rounded-lg object-cover h-52 w-full" src="{{ asset('storage/' . $post->image) }}" alt="Post Image" />

            </div>
            <div class="mb-4">
                <h1 class="text-xl font-bold text-orange-400 pt-4 hover:text-orange-800 truncate">
                    <a href="{{ route('user.view', ['id' => $post->id]) }}">{{$post->title}}</a>
                </h1>
                <small class="text-neutral-400">
                    {{ \Carbon\Carbon::parse($post->date_time)->format('F j, Y g:i A') }}
                </small>

            </div>

            <div class="pb-10">
                <div class="text-sm text-neutral-100 overflow-hidden line-clamp-5 text-justify mb-4">
                    {!! Str::limit($post->body, 500) !!}
                </div>
            </div>


            <div class="flex items-center justify-start mt-2 pb-3 flex-wrap">
                <a class="categoryoverflow bg-orange-200 text-black text-sm rounded-md px-2 py-1 mr-1">
                    {{ $post->category ? $post->category->title : 'No Category' }}
                </a>
            </div>


            <div class="flex justify-between text-neutral-600">
                <button id="heart-button" class="" disabled>
                    <i id="heart-icon" class="fas fa-heart text-orange-600"></i>
                </button>
                <button id="copyButton" data-url="http://localhost/blog/blog.php?title=${data['title']}" class="hover:text-orange-500">
                    <i class="fa-solid fa-share-nodes fa-lg"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section>



@endsection
