@extends('layouts.app')

@section('title', 'User')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url("admin/uzer/create") }}" class="btn btn-primary"> <i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Akses</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row"> {{  $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- {{ $user->is_admin }} --}}
                                {{ $user->group_id ? $user->group->name : 'Penullis' }}
                            </td>
                            <td>
                                @if (Auth::user()->is_admin)
                                <a href="{{ url("/admin/uzer/{$user->id}/edit") }}" class="btn btn-xs btn-info"><i class="fa fa-pen"></i></a>
                                <form method="POST" action="{{ url("admin/uzer/{$user->id}") }}" class="form-inline d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                {!! $users->links() !!}
        </div>
    </div>
  </div>
@endsection