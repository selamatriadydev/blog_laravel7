@extends('layouts.app')

@section('title', 'Banner')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'Update Banner') 

@section('content')
<form action="{{ url("/admin/banner/{$banner->id}") }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              @include('admin.banner._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <a href="{{ url('admin/banner') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection