<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメントの編集

            <div class="text-right">
                <a href="{{ route('otherPost.show', $comment->post_id) }}" class="text-blue-600">
                    <x-primary-button>
                        戻る
                    </x-primary-button>
                </a>
            </div>
            
        </h2>
    </x-slot>

    <br>

    <div class="max-w-7xl mx-auto px-6">

        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="w-full flex flex-col">      
                <textarea name="content"  id="body" class="w-auto py-2 border border-gray-300 rounded-md" cols="30" rows="5">{{ $comment->content }}</textarea>
            </div>


            <x-primary-button class="mt-4">
                送信
            </x-primary-button>
        </form>

    </div>
</x-app-layout>
