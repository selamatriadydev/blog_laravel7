@extends('layouts.app')

@section('title', 'Skill')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Skill')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/skill/create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="card-body"> 
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Skill</th>
                    <th scope="col">Publish</th>
                    <th scope="col">Sub Skill</th>
                    <th scope="col">Sort</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($skill as $post)
                        <tr>
                            <th scope="row">{{  $loop->iteration }} </th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->is_published ? 'YES': 'NO' }}</td>
                            <td>
                                @if (!$post->skillDetail->isEmpty())
                                <a href="{{ url("/admin/skill/{$post->id}") }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                @endif
                            </td>
                            <td>{{ $post->sort }}</td>
                            <td>
                                @if (Auth::user()->is_admin)
                                    @php
                                        if($post->is_published) {
                                            $label = 'Draft';
                                        } else {
                                            $label = 'Publish';
                                        }
                                    @endphp
                                    <form method="POST" action="{{ url("/admin/skill/{$post->id}/publish") }}" class="form-inline d-inline">
                                        @csrf 
                                        @method("PUT")
                                        <button type="submit" class="btn btn-xs btn-warning btn-flat show_confirm" data-toggle="tooltip" title='{{ $label }}' onclick="return confirm('Are you sure?');"> {{ $label }}</button>
                                    </form>
                                @endif
                            <a href="{{ url("/admin/skill/{$post->id}/edit") }}" class="btn btn-xs btn-info"><i class="fa fa-pen"></i></a>
                            <form method="POST" action="{{ url("admin/skill/{$post->id}") }}" class="form-inline d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                {!! $skill->links() !!}
            </div>
        </div>
    </div>
  </div>

@endsection