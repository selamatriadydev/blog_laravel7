<div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
    <label>Title</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $par && $par->title ? $par->title : '' }}" required>
    @if ($errors->has('title'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('title') }}</strong>
      </span>
    @endif
</div>
<div class="form-group{{ $errors->has('link') ? ' is-invalid' : '' }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" id="txtSkills" value="{{ $par && $par->link ? $par->link : '' }}" required>
    @if ($errors->has('link'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('link') }}</strong>
      </span>
    @endif
</div>
<div class="form-group{{ $errors->has('sort') ? '  is-invalid' : '' }}">
    <label>Sort</label>
    <input type="text" class="form-control" name="sort" id="txtSkills" value="{{ $par && $par->sort ? $par->sort : '' }}">
    @if ($errors->has('sort'))
      <span class="help-block">
        <strong>{{ $errors->first('sort') }}</strong>
      </span>
    @endif
</div>