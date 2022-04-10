<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    <label>Name</label>
    <input type="text" class="form-control" name="tags" id="txtSkills" value="{{ $tag && $tag->name ? $tag->name : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('tags') }}</strong>
    </span>
  </div>