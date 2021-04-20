{{--            {{$arr=array($comments)}}--}}
{{--            {{$count=0}}--}}
                @foreach($comments as $key=> $comment)

                    <div class="display-comment">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->comment }}</p>
                        @if ($loop->last)
                            <form action="{{route('comment.destroy')}}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{route('comments.edit',$comment->id)}}">
                                    <x-jet-label type="submit" >
                                        {{ __('Edit') }}
                                    </x-jet-label>
                                </a>
                                <x-jet-button type="submit" >
                                    {{ __('Delete') }}
                                </x-jet-button>
                            </form>
                        @endif

                        <a href="" id="reply"></a>
                        <form method="post" action="{{ route('reply.add') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                            </div>
                            <div class="form-group">
                                <x-jet-button type="submit" >
                                    {{ __('Replay') }}
                                </x-jet-button>
                            </div>
                        </form>
                        @include('post.partials.replys', ['comments' => $comment->replies])
                    </div>
                @endforeach

