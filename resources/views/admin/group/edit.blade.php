@extends('layouts.app')

@section('title', 'Group')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection
 
@section('page_title', 'Update Group') 

@section('content')
<form action="{{ url("/admin/group/{$par->id}") }}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
  @csrf
  @method('PUT')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              @include('admin.group._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <a href="{{ url('admin/group ') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection