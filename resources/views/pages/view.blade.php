@extends('components.main')

@include('includes.navbar')

@section('content')

<head>
    <title>{{ $posts->title }}</title>
</head>

<body class="bg-neutral-800">

    <section class="max-w-screen-md mx-auto p-2 md:p-2">
        <div class="mt-2 md:mt-10">
            <div id="image_placeholder" class="relative w-full aspect-[7/8] sm:aspect-[16/9]">
                <img src="{{ asset('storage/' . $posts->image) }}" alt="Post Image" class="absolute inset-0 w-full h-full object-cover rounded-xl" />
            </div>

            <div class="pt-2"></div>

            <div id="category_placeholder" class="flex items-center justify-start mt-0 pb-3 flex-wrap">
                <h2 class="bg-neutral-200 text-black text-sm rounded-md px-2 py-1 mt-2 mr-2">
                    {{ $posts->category ? $posts->category->title : 'No Category' }}
                </h2>
            </div>

            <div id="title_author_date" class="mt-0">
                <h1 class="font-bold text-3xl md:text-4xl text-white">
                    {{ $posts->title }}
                </h1>
                <h2 id="author&date" class="font-semibold text-sm text-neutral-500">
                    Uploaded on {{ \Carbon\Carbon::parse($posts->date_time)->format('F j, Y g:i A') }}
                </h2>
            </div>

            <div id="content_placeholder" class="py-10 text-sm md:text-lg text-justify indent-10 md:indent-20 text-neutral-200">
                {!! $posts->body !!}
            </div>

            <!-- Share Button -->
            <form action="#" method="POST" style="display: inline-block;">
                <button type="button" class="px-4 py-2 rounded-md text-white text-sm bg-indigo-500 hover:bg-indigo-600 transition duration-200" onclick="copyToClipboard()">Share</button>
            </form>

            <!-- Like Button -->
            @auth
            <form action="{{ route('user.like', ['id' => $posts->id]) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm bg-indigo-500 hover:bg-indigo-600 transition duration-200">
                    {{ $userHasLiked ? 'Unlike' : 'Like' }}
                </button>
            </form>

            <!-- Display Like Count -->
            @if ($userHasLiked)
            <p style="display: inline-block;" class="text-white ml-2">
                You and {{ $totalLikes - 1 }} other{{ ($totalLikes - 1) == 1 ? '' : 's' }} liked this
            </p>
            @else
            <p style="display: inline-block;" class="text-white ml-2">
                {{ $totalLikes }} like{{ $totalLikes == 1 ? '' : 's' }}
            </p>
            @endif

            <!-- Comment Form -->
            <form action="{{ route('user.comment', ['id' => $posts->id]) }}" method="POST" class="mt-4">
                @csrf
                <textarea class="bg-neutral-700 rounded-md border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-500 text-white focus:outline-none focus:bg-neutral-600" name="comment_text" placeholder="Write your comment..." required></textarea>
                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm bg-indigo-500 hover:bg-indigo-600 transition duration-200 mt-2 w-full">Submit Comment</button>
            </form>

            @else
            <p>Please <a href="{{ route('user.login') }}" class="text-red-400">sign in</a> to like or comment on this post.</p>
            @endauth

            <!-- Display Comments -->
            <h3 class="font-bold text-white mb-4 mt-6">Comments:</h3>
            @foreach ($posts->comments as $comment)
            <div class="flex gap-4 items-start mb-4 border-b border-neutral-600 pb-4">
                <img src="https://cdn-icons-png.freepik.com/512/12467/12467867.png" class="object-cover w-12 h-12 rounded-full border-2 border-white shadow-lg" />
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold text-white">{{ $comment->user->username }}</h3>
                        <h3 class="text-sm font-semibold text-neutral-400">{{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y g:i A') }}</h3>
                    </div>
                    <p class="text-neutral-300">{{ $comment->comment_text }}</p>
                </div>
            </div>
            @endforeach

        </div>

        <a href="{{ route('user.index') }}" class="px-4 py-2 rounded-md text-white text-sm bg-indigo-500 hover:bg-indigo-600 transition duration-200 mt-6 block text-center">Back</a>
    </section>

</body>

<script>
    function copyToClipboard() {
        var url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            alert('Post URL copied to clipboard!');
        }, function() {
            alert('Failed to copy URL!');
        });
    }
</script>

@endsection
