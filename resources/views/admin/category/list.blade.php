@extends('layouts.app')

@section('title', 'Category')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Category')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/categories/create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="card-body"> 
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $post)
                        <tr>
                            <th scope="row">{{  $loop->iteration }} </th>
                            <td>{{ $post->name }}</td>
                            <td>
                            <a href="{{ url("/admin/categories/{$post->id}/edit") }}" class="btn btn-xs btn-info"><i class="fa fa-pen"></i></a>
                            <form method="POST" action="{{ url("admin/categories/{$post->id}") }}" class="form-inline d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
  </div>

@endsection