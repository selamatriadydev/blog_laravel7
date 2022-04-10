@extends('layouts.frontend')

@section('title', 'Blog')

@section('navbar')
    @include('frontend/components/navbar')
@endsection

@section('page_title', 'Info Blog') 

@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">  
              <h4>{{ $post->title }} - <small>by {{ $post->user->name }}</small></h4>
              <span class="pull-right">
                {{ $post->created_at->toDayDateTimeString() }}
                </span>
            </div>
              <div class="card-body">
                <p>{!! $post->body !!}</p>
            </div>
            <div class="card-footer">
                <p>
                    Tags:
                    @forelse ($post->tags as $tag)
                        <span class="label label-default">{{ $tag->name }}</span>
                    @empty
                        <span class="label label-danger">No tag found.</span>
                    @endforelse
                </p>
                <p>
                    <span class="btn btn-sm btn-success">{{ $post->category->name }}</span>
                </p>
            </div>
          </div>
      </div>
    </div>
    {{-- @includeWhen(Auth::user(), 'frontend._form') --}}
    @include('frontend._form')
    @include('frontend._comments')


@endsection