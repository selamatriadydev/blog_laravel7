@extends('layouts.app')

@section('title', 'Category')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'New Category') 

@section('content')
<form action="{{ url("/admin/categories/{$category->id}") }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              @include('admin.category._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <a href="{{ url('admin/categories') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection