<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label>Menu</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $menus && $menus->title ? $menus->title : '' }}">
    <span class="help-block">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
</div>
<input type="hidden" class="form-control" name="parent_id" id="txtSkills" value="{{$menus->parent_id}}">
<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" id="txtSkills" value="{{ $menus && $menus->link ? $menus->link : '' }}">
    <span class="help-block">
      <strong>{{ $errors->first('title') }}</strong>
    </span>
</div>