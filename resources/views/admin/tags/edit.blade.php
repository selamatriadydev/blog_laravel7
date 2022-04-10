@extends('layouts.app')

@section('title', 'Tags')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection
 
@section('page_title', 'New Tags') 

@section('content')
<form action="{{ url("/admin/tags/{$tag->id}") }}" method="post">
  @csrf
  @method('PUT')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              @include('admin.tags._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <a href="{{ url('admin/tags') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection