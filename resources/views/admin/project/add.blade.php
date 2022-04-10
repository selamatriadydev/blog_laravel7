@extends('layouts.app')

@section('title', 'Project')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'New Project') 

@section('content')
<form action="{{ url('/admin/project') }}" method="post"  class="needs-validation" novalidate="" enctype="multipart/form-data">
  @csrf
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
              @include('admin.project._form')
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Save</button>
            <button class="btn btn-danger mr-2" type="reset">Reset</button>
            <a href="{{ url('admin/project') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
</form>


@endsection