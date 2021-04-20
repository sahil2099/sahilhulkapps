<x-app-layout>
    <x-jet-secondary-button>
        <a href="{{route('posts.create')}}">Create Post</a>
    </x-jet-secondary-button>
    <div class="py-3">
        <div class="max-w-4xl mx-auto sm:px-2 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(isset($posts))
                <table >
                    <tr>
                        <th>No</th>
                        <th>Auther</th>
                        <th>Title</th>
                        <th>create_at</th>
                        <th>Action</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{$post->User->name}}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{$post->created_at}}</td>
                            @if($post->user->id==Auth::user()->id)
                            <td>

                                <a href="{{ route('posts.show',$post->slug) }}" >  <x-jet-button type="submit" >
                                        {{ __('View') }}
                                    </x-jet-button></a>
{{--                                @if()--}}
                                <a href="{{ route('posts.edit',$post->slug) }}" >  <x-jet-button type="submit" >
                                        {{ __('Edit') }}
                                    </x-jet-button></a>
{{--                                @endif--}}
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                  <x-jet-button type="submit" >
                                        {{ __('Delete') }}
                                    </x-jet-button>
                                </form>
                            </td>
                            @else
                            <td>
                                <a href="{{ route('posts.show',$post->slug) }}" >  <x-jet-button type="submit" >
                                        {{ __('View') }}
                                    </x-jet-button></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
                    {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
