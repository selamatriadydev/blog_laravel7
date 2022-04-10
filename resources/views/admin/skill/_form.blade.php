<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label>Title</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $par && $par->title ? $par->title : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('title') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
    <label>Sort</label>
    <input type="text" class="form-control" name="sort" id="txtSkills" value="{{ $par && $par->sort ? $par->sort : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('sort') }}</strong>
    </span>
</div>