<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card w-full bg-base-100 shadow-xl my-4">
                <div class="card-body">
                  <h2 class="card-title">{{ $post->user->name }} - <span class="text-gray-500 text-sm">{{ $post->created_at }}</span></h2>
                  <p>{{ $post->body }}</p>
                </div>
              </div>

              <form action="{{ route('post.comment.store', $post) }}" method="post">
                @csrf
                @error('body')
                    <span class="text-error block">{{ $message }}</span>
                @enderror
                <textarea name="body" class="w-full rounded block textarea textarea-bordered @error('body') textarea-error @enderror" rows="3" placeholder="Leave a comment">{{ old('body') }}</textarea>
                <input type="submit" value="Comment" class="btn mt-2">

            </form>

            <div class="alert alert-info shadow-lg my-4">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <span>List Comment</span>
                </div>
              </div>

            @foreach ($post->comments as $comment)
            <div class="card w-full bg-base-100 shadow-xl my-4">
                <div class="card-body">
                  <h2 class="card-title">{{ $comment->user->name }} - <span class="text-gray-500 text-sm">{{ $comment->created_at }}</span>
                  @can('delete', $comment)
                    <form action="{{ route('post.comment.destroy', [$comment->post, $comment]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="Delete" class="btn btn-error text-white">
                    </form>
                  @endcan
                  </h2>
                  <p>{{ $comment->body }}</p>
                </div>
              </div>
            @endforeach
        </div>

        
    </div>
</x-app>