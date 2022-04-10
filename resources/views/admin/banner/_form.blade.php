<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label>Title</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $banner && $banner->title ? $banner->title : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('title') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    <label>Body</label>
    <input type="text" class="form-control" name="body" id="txtSkills" value="{{ $banner && $banner->body ? $banner->body : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('body') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
  <label>Gambar</label>
  <input type="file" class="form-control" name="image">
  @if ($banner && $banner->file_path)
    <img src="{{ url($banner->file_path) }}" alt="" width="100px">
  @endif
  <span class="help-block">
    <strong>{{ $errors->first('image') }}</strong>
  </span> 
</div>
<div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
    <label>Sort</label>
    <input type="text" class="form-control" name="sort" id="txtSkills" value="{{ $banner && $banner->sort ? $banner->sort : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('sort') }}</strong>
    </span>
</div>