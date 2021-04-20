<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('posts.update',$post->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="">Title</label>
                    </div>
                    <div>
                        <input type="text" name="title" id="title" placeholder="title" value="{{$post->title}}" >
                        <x-jet-button type="submit" >
                            {{ __('Update') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
