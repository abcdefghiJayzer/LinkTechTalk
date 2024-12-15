@foreach ($posts as $post)
<article class="post p-4 bg-neutral-900 max-w-xs shadow rounded-xl mx-auto">
    <!-- Image -->
    <div>
        <img class="rounded-lg object-cover h-52 w-full" src="{{ asset('storage/' . $post->image) }}" alt="Post Image" />
    </div>

    <!-- Title and Date -->
    <div class="mb-4">
        <h1 class="text-xl font-bold text-orange-400 pt-4 hover:text-orange-800 truncate">
            <a href="{{ route('user.view', ['id' => $post->id]) }}">{{ $post->title }}</a>
        </h1>
        <small class="text-neutral-400">
            {{ \Carbon\Carbon::parse($post->date_time)->format('F j, Y g:i A') }}
        </small>
    </div>

    <!-- Post Body Preview -->
    <div class="text-sm text-neutral-100 overflow-hidden line-clamp-5 text-justify mb-4">
        {!! Str::limit($post->body, 200) !!}
    </div>

    <!-- Category -->
    <div class="flex items-center justify-start mt-2 pb-3 flex-wrap">
        <a class="bg-orange-200 text-black text-sm rounded-md px-2 py-1 mr-1">
            {{ $post->category ? $post->category->title : 'No Category' }}
        </a>
    </div>

    <!-- Actions: Like and Share -->
    <div class="flex justify-between text-neutral-600">
        <button id="heart-button" class="" disabled>
            <i id="heart-icon" class="fas fa-heart text-orange-600"></i>
        </button>
        <button id="copyButton" data-url="http://localhost/blog/blog.php?title=${data['title']}" class="hover:text-orange-500">
            <i class="fa-solid fa-share-nodes fa-lg"></i>
        </button>
    </div>
</article>
@endforeach
