<div class="row">
     <!-- comentar  -->
  <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h4>Komentar apa ya ? Apa aja.</h4>
        </div>
        <div class="card-body">
        <blockquote class="blockquote">
            <p class="mb-0">Kata apapun itu, jika di ketik di kolom komentar itu pasti komentar.</p>
            <footer class="blockquote-footer">Selamat Riady <cite title="Source Title">2022</cite></footer>
        </blockquote>
        </div>
    </div>
  </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">  
            <h4>Write Comment </h4>
            </div>
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
                        Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>