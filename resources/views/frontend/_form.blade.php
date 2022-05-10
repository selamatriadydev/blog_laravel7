<form action="{{ Auth::user() ? url("blog/{$post->id}/comment") : url("blog/{$post->id}/comments") }}" method="post" >
    <div class="card-body">
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
            <div class="form-group">
                <label>Website</label>
                <input type="text" name="website" class="form-control">
            </div>
            @endif
        </div> 
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Add Comment
            </button>
        </div>
    </form>