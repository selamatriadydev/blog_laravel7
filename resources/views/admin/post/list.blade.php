@extends('layouts.app')

@section('title', 'Post')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Post')



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/posts/create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Catergory</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Publish</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row"> {{  $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->tags->implode('name', ', ') }}</td>
                            <td>{{ $post->published }}</td>
                            <td>
                                @if (Auth::user()->is_admin)
                                @php
                                    if($post->published == 'Yes') {
                                        $label = 'Draft';
                                    } else {
                                        $label = 'Publish';
                                    }
                                @endphp
                                {{-- <a href="{{ url("/admin/posts/{$post->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-warning">{{ $label }}</a> --}}
                                <form method="POST" action="{{ url("/admin/posts/{$post->id}/publish") }}" class="form-inline d-inline">
                                    @csrf 
                                    @method("PUT")
                                    <button type="submit" class="btn btn-xs btn-warning btn-flat show_confirm" data-toggle="tooltip" title='{{ $label }}' onclick="return confirm('Are you sure?');"> {{ $label }}</button>
                                </form>
                            @endif
                            <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            {{-- <a href="{{ url("admin.posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> --}}
                            <a href="{{ url("/admin/posts/{$post->id}/edit") }}" class="btn btn-xs btn-info"><i class="fa fa-pen"></i></a>
                            <form method="POST" action="{{ url("admin/posts/{$post->id}") }}" class="form-inline d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf 
                                @method("DELETE")
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete' > <i class="fa fa-trash"> </i></button>
                            </form>
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
                {!! $posts->links() !!}
                {{-- <nav aria-label="...">
                    <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div>
  </div>
@endsection