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
                    <th>Title</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $post->User->name }}</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    </tbody>
                </table>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Display Comments</h5>
                                        @include('post.partials.replys', ['comments' => $post->comments, 'post_id' => $post->id])
                                        <hr />
                                    </div>

                                    <div class="card-body">
                                        <h5>Leave a comment</h5>
                                        <form method="post" action="{{route('posts.comments.store',['id'=>$post->id])}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="comment" class="form-control" />

                                                <input type="hidden" name="post_id" value="{{$post->id}}" />
                                            </div>
                                            <div class="form-group">
                                                <x-jet-button type="submit" >
                                                    {{ __('Add Comment') }}
                                                </x-jet-button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
