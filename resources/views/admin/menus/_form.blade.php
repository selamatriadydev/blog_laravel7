<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label>Menu</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $menus && $menus->title ? $menus->title : '' }}">
    <span class="help-block">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" id="txtSkills" value="{{ $menus && $menus->link ? $menus->link : '#' }}">
    <span class="help-block">
      <strong>{{ $errors->first('link') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
    <label>Parent</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0">pilih Parent</option>
        @foreach ($parent as $item)
            <option value="{{ $item->id }}" {{ $menus && $menus->parent_id==$item->id ? 'selected=""': '' }}> {{ $item->title }}</option>
        @endforeach
    </select>
    <span class="help-block">
      <strong>{{ $errors->first('parent_id') }}</strong>
    </span>
</div>
<div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
    <label>Sort</label>
    <input type="text" class="form-control" name="sort" id="txtSkills" value="{{ $menus && $menus->sort ? $menus->sort : '0' }}">
    <span class="help-block">
      <strong>{{ $errors->first('sort') }}</strong>
    </span>
</div>