<div class="form-group{{ $errors->has('category_id') ? ' is-invalid' : '' }} ">
    <label>Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">pilih Parent</option>
        @foreach ($category as $item)
            <option value="{{ $item->id }}" {{ $par && $par->category_id==$item->id ? 'selected=""': '' }}> {{ $item->title }}</option>
        @endforeach
    </select>
    @if ($errors->has('category_id'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
      </span>
    @endif
</div>
<div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
    <label>Title</label>
    <input type="text" class="form-control" name="title" id="txtSkills" value="{{ $par && $par->title ? $par->title : '' }}" required>
    @if ($errors->has('title'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('title') }}</strong>
      </span>
    @endif
</div>
<div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
    <label>Image</label>
    <input type="file" class="form-control" name="image" id="txtSkills" required>
    @if ($errors->has('image'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('image') }}</strong>
      </span>
    @endif
    @if ($par && $par->file_path)
        <img src="{{ url($par->file_path) }}" width="50px" />
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