<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメントを投稿する

            <div class="text-right">
                <a href="{{ route('otherPost.show', $post) }}" class="text-blue-600">
                    <x-primary-button>
                        戻る
                    </x-primary-button>
                </a>
            </div>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <form method="post" action="{{ route('comments.store', ['post' => $post->id]) }}">
            @csrf
            <div class="w-full flex flex-col">
                <label for="content" class="font-semibold mt-4">コメント</label>
                <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                <textarea name="content" class="w-auto py-2 border border-gray-300 rounded-md" id="content" cols="30" rows="5">{{ old('content') }}</textarea>
            </div>

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <x-primary-button class="mt-4">
                コメントを送信
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
