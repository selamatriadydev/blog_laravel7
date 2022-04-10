@extends('layouts.app')

@section('title', 'Comment')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Comment')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body"> 
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Article</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($comments as $post)
                        <tr>
                            <th scope="row">{{  $loop->iteration }} </th>
                            <td>{{ $post->post->title }}</td>
                            <td>{{ $post->body }}</td>
                            <td>
                                <a href="{{ url("/admin/comments/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No post available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
            <div class="card-footer">
                {!! $comments->links() !!}
            </div>
        </div>
    </div>
  </div>

@endsection