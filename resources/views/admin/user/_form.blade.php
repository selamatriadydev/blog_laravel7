<div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control" name="name" tabindex="1"  value="{{ $user && $user->name ? $user->name : old('name') }}" required autocomplete="name" autofocus>
    @error('name')
        <div class="help-block">
            <strong>{{ $message }}</strong> 
        </div>
    @enderror
  </div>

  <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
    <label for="email">{{ __('E-Mail Address') }}</label>
    <input id="email" type="email" class="form-control" name="email" tabindex="2"  value="{{  $user && $user->email ? $user->email : old('email') }}" required autocomplete="email">
    @error('email')
        <div class="help-block">
            <strong>{{ $message }}</strong> 
        </div>
    @enderror
  </div>

  <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
    <div class="d-block">
        <label for="password" class="control-label">{{ __('Password') }}</label>
    </div>
    <input id="password" type="password" class="form-control" name="password" tabindex="3" {{  $isUpdate ? '' : 'required' }} autocomplete="new-password">
    @error('password')
        <div class="help-block">
            <strong>{{ $message }}</strong> 
        </div>
    @enderror
  </div>

  <div class="form-group {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
    <div class="d-block">
        <label for="password_confirmation" class="control-label">{{ __('Confirm Password') }}</label>
    </div>
    <input  type="password" class="form-control" id="password_confirmation" name="password_confirmation" tabindex="4"  {{  $isUpdate ? '' : 'required' }} autocomplete="new-password">
  </div>

  <div class="form-group {{ $errors->has('group') ? 'is-invalid' : '' }}">
    <div class="d-block">
        <label for="group" class="control-label">{{ __('Group') }}</label>
    </div>
    <select class="form-control" name="group_id" >
        <option value="">Pilih satu</option>
        @foreach ($group as $item)
        <option value="{{ $item->id }}" {{ $user && $user->group_id==$item->id ? 'selected': '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    
  </div>