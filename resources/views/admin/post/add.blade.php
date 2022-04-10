@extends('layouts.app')

@section('title', 'Post')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'New Post') 

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<form action="{{ url('/admin/posts') }}" method="post" enctype="multipart/form-data">
  @csrf
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Masukan Judul" name="title" required autofocus>
                  <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                  </span>
              </div>
              <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                <label>Tag</label>
                <input type="text" class="form-control" name="tags" id="txtSkills" data-role="tagsinput" value="PHP">
                <span class="help-block">
                  <strong>{{ $errors->first('tag') }}</strong>
                </span>
              </div>
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <button class="btn btn-danger mr-2" type="reset">Reset</button>
            <a href="{{ url('admin/posts') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="card-body">
              <div class="form-group{{ $errors->has('preview') ? ' has-error' : '' }}">
                <label>Body Preview</label>
                <textarea class="form-control" name="preview"></textarea>
                <p>Maksimal 200 karakter</p>
                <span class="help-block">
                  <strong>{{ $errors->first('preview') }}</strong>
                </span>
              </div>
              <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                <label>Body Content</label>
                <textarea class="form-control" name="body" id="editor"></textarea>
                <span class="help-block">
                  <strong>{{ $errors->first('body') }}</strong>
                </span>
              </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body">
              <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                <label>Gambar</label>
                <input type="file" class="form-control" name="image">
                <span class="help-block">
                  <strong>{{ $errors->first('image') }}</strong>
                </span>
              </div>
              <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label>Category</label>
                <select class="form-control" data-height="100%" style="height: 100%;" name="category">
                  <option value="">Pilih </option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <span class="help-block">
                  <strong>{{ $errors->first('category') }}</strong>
                </span>
              </div>
              <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label>Status</label>
                <select class="form-control" data-height="100%" style="height: 100%;" name="status">
                  <option value="1">Publish</option>
                  <option value="0">Draft</option>
                </select>
                <span class="help-block">
                  <strong>{{ $errors->first('status') }}</strong>
                </span>
              </div>
          </div>
        </div>
    </div>
  </div>
</form>
<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection