@foreach ($post->comments as $comment)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
            </div>
        </div>
      </div>
@endforelse
