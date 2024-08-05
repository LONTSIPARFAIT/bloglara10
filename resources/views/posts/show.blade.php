<x-default-layout title="{{ $post->title }}">
  {{-- <x-layout :title="$post->title "> --}}

    <div class="space-y-10 md:space-y-16 mb-5">
        {{-- Nombre d'article : {{ $total }} --}}

        <x-post :$post/>

        @auth
            <form action="{{ route('posts.comment',['post'=>$post]) }}" method="post">
              @csrf
              <div class="flex h-12">
                <input type="text" name="comment" autocomplete="off" placeholder="Quelque chose a rajouter ??" class="z-full bg-red-50 text-slate-900 focus:outline focus:outline-2 focus:outline-indigo-500 rounded-lg px-5">
                <button class="ml-2 w-12 flex justify-center text-white bg-indigo-700 shrink-0 items-center rounded-full">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-3 9h-4v4h-2v-4H7V9h4V5h2v4h4v2z"></path></svg>
                </button>
              </div>

              @error('comment')
                  <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror

            </form>
        @endauth
        <div class="space-y-8">
            @foreach ($post->comments as $comment )
                <div class="flex bg-slate-50 p-6 rounded-lg">
                    <img class="w-10 h-10 sm:w-12 objet-cover rounded-full"
                    src="{{ Gravatar::get($comment->user->email)}}"
                    alt="Image de profil de {{ $comment->user->name }}">
                    <div class="ml-4 flex flex-col">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <h2 class="font-bold text-slate-900 text-2xl">{{ $comment->user->name }}</h2>
                            <time class="mt-2 sm:mt-0 sm:ml-4" datetime="{{ $comment->created_at}}">@datetime( $comment->created_at)</time>

                        </div>
                        <p class="mt-4 text-slate-800 sm:leading-loose">{{ $comment->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-default-layout>

{{-- composer require creativeorange/gravatar --}}
