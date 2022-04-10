@extends('layouts.app')

@section('title', 'Post')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'Show Post')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <b>{{ $post->title }}</b>
              <p>{{ $post->body }}</p>
              <p><strong>Category: </strong>{{ $post->category->name }}</p>
            <p><strong>Tags: </strong>{{ $post->tags->implode('name', ', ') }}</p>
            <p><strong>Publish: </strong>{{ $post->is_published ? 'Publish' : 'Draft' }}</p>
          </div>
          <div class="card-footer text-right">
            <a href="{{ url('admin/posts') }}" class="btn btn-danger mr-1">Back</a>
          </div>
        </div>
    </div>
  </div>
@endsection