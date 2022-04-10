@extends('layouts.app')

@section('title', 'Skill')

@section('navbar')
    @include('admin/components/navbar')
@endsection

@section('sidebar')
    @include('admin/components/sidebar')
@endsection

@section('page_title', 'List Sub Skill '.$skill->title)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/skill') }}" class="btn btn-primary"> <i class="fa fa-eye"></i>Back</a>
            </div>
            <div class="card-body"> 
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Skill</th>
                    <th scope="col">Publish</th>
                    <th scope="col">Sort</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($skillDetail as $post)
                        <tr>
                            <th scope="row">{{  $loop->iteration }} </th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->is_published ? 'YES': 'NO' }}</td>
                            <td>{{ $post->sort }}</td>
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
                {!! $skillDetail->links() !!}
            </div>
        </div>
    </div>
  </div>

@endsection