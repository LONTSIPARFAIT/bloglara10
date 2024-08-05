<x-default-layout :title="$post->exists() ? 'Modifier un post':'Créer un post'">
  <form action="{{ $post->exists() ? route('admin.posts.update',['post'=>$post]) : route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    @if ($post->exists())
      @method('patch')
    @endif
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h1 class="text-base font-semibold leading-7 text-gray-900">{{ $post->exists() ? 'Modifier : " '. $post->title .' "':'Créer un post' }}</h1>
            <p class="mt-1 text-sm leading-6 text-gray-600">Révélons au monde nos talents</p>

            <div class="mt-10 space-y-8 md:w-2/3">
               <x-input name="title" label="Titre" :value="$post->title" />
               <x-input name="slug" label="slug" help="Laisser vide pour un slug auto. Si la valeur est renseignée, elle sera slugifiée avant d'etre soumise à la validation" :value="$post->slug" />
               {{-- textarea content --}}
               <x-textarea name="content" label="Contenue du post">{{ $post->content }}</x-textarea>
               {{-- input file thumbnail --}}
               <x-input name="thumbnail" type="file" label="Image de couverture" :value="$post->thumbnail" />
               {{-- select  category_id --}}
               <x-select name="category_id" label="Catégorie" :list="$categories" :value="$post->categoidry_" />
               {{-- select multiple tag_ids --}}
               <x-select name="tag_ids" label="Etiquettes" :list="$tags" multiple :value="$post->tags" />
            </div>
        </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md bg-green-950 px-3 py-2 text-sm font-semibold hover:text-green-950 text-green-300 shadow-sm hover:bg-green-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $post->exists() ? 'Mettre à jour':'Publier' }}</button>
    </div>
  </form>
</x-default-layout>
