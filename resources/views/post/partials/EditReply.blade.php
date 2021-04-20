<x-app-layout>
    <x-jet-secondary-button>
        <a href="{{route('posts.index')}}"> Back</a>
    </x-jet-secondary-button>
    <div class="py-3">
        <div class="max-w-4xl mx-auto sm:px-2 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table >
                    <thead>
                    <th>Auther</th>

                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $comment->User->name }}</td>

                    </tr>
                    </tbody>
                </table>

                <form method="post" action="{{route('comments.update',$comment->id)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control" value="{{$comment->comment}}"/>
{{--                        <input type="hidden" name="post_id" value="{{$post->id}}" />--}}
                    </div>
                    <div class="form-group">
                        <x-jet-button type="submit" >
                            {{ __('update comment') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
