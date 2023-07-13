<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事表示

            <div class="text-right">
                <a href="{{route('post.index',$post)}}" class="text-blue-600">
                    <x-primary-button>
                        投稿一覧に戻る
                    </x-primary-button>
                </a>
            </div>

        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white w-full rounded-2xl">
            <div class="mt-4 p-4">
                <h1 class="text-lg font-semibold">
                    {{$post->title}}
                </h1>

                <div class="text-right flex">
                    <a href="{{route('post.edit',$post)}}" class="flex-1">
                        <x-primary-button>
                            編集
                        </x-primary-button>
                    </a>

                    <form method="post" action="{{route('post.destroy', $post)}}" class="flex-2">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-700 ml-2" style="background-color: red; color: white;">
                            削除
                        </x-primary-button>
                    </form>

                </div>

                <hr class="w-full">
                <p class="mt-4 whitespace-pre-line">
                    {{$post->body}}
                </p>
                <div class="text-sm font-semibold flex frex-row-reverse">
                    <p>{{$post->created_at}}</p>
                </div>
            </div>
        </div>


        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-8">
            コメント

            <div class="text-right flex">
                <a href="{{route('comments.create', ['post' => $post->id])}}" class="flex-1">
                    <x-primary-button>
                        コメントを投稿する
                    </x-primary-button>
                </a>
            </div>
        </h2>

        @foreach ($post->comments as $comment)
        <div class="mt-4 p-4 bg-white w-full rounded-2xl">
            <p class="whitespace-pre-line">{{$comment->content}}</p>
            <div class="text-sm font-semibold flex flex-row-reverse items-center mb-4">
                <p>{{$comment->created_at}} / {{$comment->user->name??'匿名'}}</p>
                <span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
                @if ($comment->user_id === Auth::user()->id)
                    <div class="flex space-x-4">
                        <a href="{{ route('comments.edit', $comment) }}">編集</a>
                        <span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
        
    </div>
</x-app-layout>
