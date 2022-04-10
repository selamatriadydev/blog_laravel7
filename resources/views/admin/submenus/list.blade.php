@extends('layouts.app')

@section('title', 'Menus')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Menus')



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url("admin/submenus/{$IdParent}/create") }}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Link</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $post)
                        <tr>
                            <th scope="row"> {{  $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->link=='#' ? 'Parent' : $post->link }}</td>
                            <td>
                                <a href="{{ url("/admin/menus/{$post->id}") }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                @if (Auth::user()->is_admin)
                                <a href="{{ url("/admin/menus/{$post->id}/edit") }}" class="btn btn-xs btn-info"><i class="fa fa-pen"></i></a>
                                <form method="POST" action="{{ url("admin/menus/{$post->id}") }}" class="form-inline d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf 
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete' > <i class="fa fa-trash"> </i></button>
                                </form>
                            @endif
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
                {!! $menus->links() !!}
        </div>
    </div>
  </div>
@endsection