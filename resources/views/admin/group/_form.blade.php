<div class="form-group{{ $errors->has('name') ? ' is-invalid' : '' }}">
    <label>name</label>
    <input type="text" class="form-control" name="name" id="txtSkills" value="{{ $par && $par->name ? $par->name : '' }}" required>
    @if ($errors->has('name'))
      <span class="help-block">
        <strong class="text-danger">{{ $errors->first('name') }}</strong>
      </span>
    @endif
</div>
<div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
  <div class="card">
    <div class="card-header">
      <h4>Menu</h4>
    </div>
    <div class="card-body">
      <ul class="list-group">
        @foreach ($menu as $item)
          @if( $item->parent_id == 0 )
          <li class="list-group-item">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="defaultCheck{{ $item->id }}" name="menu-{{ $item->id }}" {{ $par && App\MenuData::where(['menus_id'=>$item->id])->count() ? 'checked' : '' }}>
              <label class="form-check-label" for="defaultCheck{{ $item->id }}">
                {{ $item->title }}
              </label>
            </div>
          {{-- </li> --}}
          @endif
          @if( ! $item->children->isEmpty() )
            <ul class="list-group">
              @foreach($item->children as $sub)
                <li class="list-group-item">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="defaultCheck{{ $sub->id }}" name="menu-{{ $sub->id }}" {{ $par && App\MenuData::where(['menus_id'=>$item->id])->count() ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultCheck{{ $sub->id }}">
                      {{ $sub->title }}
                    </label>
                  </div>
                </li>
                @endforeach
            </ul>
          @endif
        @endforeach
      </ul>
    </div>
  </div>
</div>