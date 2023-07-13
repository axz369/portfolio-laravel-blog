<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新規投稿

            <div class="text-right">
                <div class="inline-block ml-auto space-x-4">
                    <a href="{{ route('post.index') }}" class="text-blue-600">
                        <x-primary-button>
                            自分の投稿一覧に戻る
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">タイトル</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title"
                    value="{{old('title')}}">
                </div>
            </div>

            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="5">{{old('body')}}</textarea>
            </div>

            <x-primary-button class="mt-4">
                送信
            </x-primary-button>
                
        </form>
    </div>

</x-app-layout>
