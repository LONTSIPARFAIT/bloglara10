<x-default-layout>
<div class="space-y-10 md:space-y-16 mb-5">
  {{-- Nombre d'article : {{ $total }} --}}

  @forelse ($posts as $post)
    <x-post :$post list/>
    {{-- <x-post :post="$post" list/> --}}


    @empty
        <p class="text-center font-bold text-[1.5rem] text-red-900">Aucun Resultat</p>
  @endforelse

  {{ $posts->links() }}
</div>
</x-default-layout>
{{-- composer require laravel-lang/common --dev
php artisan lang:add fr --}}
