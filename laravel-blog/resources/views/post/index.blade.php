<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            自分の投稿一覧

            <div class="text-right">
                <div class="inline-block ml-auto space-x-4">
                    <a href="{{ route('post.create') }}" class="text-blue-600">
                        <x-primary-button>
                            新規投稿する
                        </x-primary-button>
                    </a>

                    <a href="{{ route('otherPost.index') }}" class="text-blue-600">
                        <x-primary-button>
                            みんなの投稿
                        </x-primary-button>
                    </a>
                </div>
            </div>

            <br>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl flex">
            <h1 class="p-4 text-lg font-semibold">
                <a href="{{route('post.show',$post)}}" class="text-blue-600">
                    {{$post->title}}
                </a>
            </h1>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
