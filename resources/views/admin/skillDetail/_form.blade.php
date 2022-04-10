<div class="form-group{{ $errors->has('skill_id') ? ' is-invalid' : '' }} ">
    <label>Skill</label>
    <select name="skill_id" id="skill_id" class="form-control" required>
        <option value="">pilih Parent</option>
        @foreach ($skill as $item)
            <option value="{{ $item->id }}" {{ $par && $par->skill_id==$item->id ? 'selected=""': '' }}> {{ $item->title }}</option>
        @endforeach
    </select>
    @if ($errors->has('skill_id'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('skill_id') }}</strong>
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
<div class="form-group{{ $errors->has('sort') ? '  is-invalid' : '' }}">
    <label>Sort</label>
    <input type="text" class="form-control" name="sort" id="txtSkills" value="{{ $par && $par->sort ? $par->sort : '' }}">
    @if ($errors->has('sort'))
      <span class="help-block">
        <strong>{{ $errors->first('sort') }}</strong>
      </span>
    @endif
</div>