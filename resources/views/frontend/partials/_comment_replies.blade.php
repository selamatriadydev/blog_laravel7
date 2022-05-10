@foreach ($comments as $comment)
            <div class="display-comment" >
                    <div class="card-header">  
                        <h4>
                        @if ($comment->user_id)
                            {{-- {{ $comment->user->name }} --}}
                            Admin
                        @elseif ($comment->comment_user_id)
                            {{ $comment->userbiasa->name }}
                        @else
                            Pengunjung
                        @endif
                        says... </h4>
                        <span class="pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">
                        <p>{{ $comment->body }}</p>
                        
                    </div>
                    <form action="{{ Auth::user() ? url("blog/{$post->id}/comment") : url("blog/{$post->id}/comments") }}" method="post" >
                        <input type="hidden" name="post_id" value="{{ $post_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        <input type="hidden" name="reply" value="1" />
                        <div class="card-footer">
                            @csrf
                            <textarea name="body" id="" rows="3" class="form-control"></textarea>
                            @if (!Auth::user())
                            <div class="form-group">
                                <label>Nama *</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            @endif
                        </div> 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Reply
                            </button>
                        </div>
                    </form>
                    @include('frontend.partials._comment_replies', ['comments' => $comment->replies])
            </div>
@endforeach
