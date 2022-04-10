@extends('layouts.app')

@section('title', 'Group')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'New Group') 

@section('content')
<form action="{{ url('/admin/group') }}" method="post"  class="needs-validation" novalidate="" enctype="multipart/form-data">
  @csrf
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
              @include('admin.group._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <button class="btn btn-danger mr-2" type="reset">Reset</button>
            <a href="{{ url('admin/group') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection