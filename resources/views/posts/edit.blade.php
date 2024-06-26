<x-layout>

    <a href="{{route('dashboard')}}" class="block mb-2 text-xs
    text-blue-500"> &larr; Go back to your dashboard</a>

    {{-- Post form --}}
    <div class="card">

        <h2 class="font-bold mb-4 ">Update your post</h2>
        <form action="{{route("posts.update", $post)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$post->title}}" placeholder="title" class="input
                @error("title") ring-red-500 @enderror"/>

                @error("title")
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body--}}
            <div class="mb-4">
                <label for="body">Body</label>
                <textarea name="body" rows="5" class="input
                @error("body") ring-red-500 @enderror">{{$post->body}}</textarea>

                @error("body")
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            @if($post->image)
                <div class="h-64 rounded-md mb-4 w-1/4 object-cover overflow-hidden">

                    <label>Current cover photo</label>
                    <img src="{{asset(('storage/'.$post->image))}}" alt="">
                </div>
            @endif

            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image">

                @error("image")
                <p class="error">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit Button--}}
            <button class="btn">Update Post</button>
        </form>
    </div>

</x-layout>
