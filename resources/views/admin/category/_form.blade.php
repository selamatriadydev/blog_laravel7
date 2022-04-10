<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
    <label>Name</label>
    <input type="text" class="form-control" name="category" id="txtSkills" value="{{ $category && $category->name ? $category->name : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('category') }}</strong>
    </span>
  </div>