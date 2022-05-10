@extends('layouts.frontend')

@section('title', 'Blog')

@section('navbar')
    @include('frontend/components/navbar')
@endsection

@section('page_title', 'Info Blog') 

@section('content')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
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
    <div class="row">
        <!-- comentar  -->
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                <h4>Display Comments</h4>
                </div> --}}
                {{-- <div class="card-body"> --}}
                    @include('frontend.partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Komentar apa ya ? Apa aja.</h4>
                </div>
                <div class="card-body">
                <blockquote class="blockquote">
                    <p class="mb-0">Kata apapun itu, jika di ketik di kolom komentar itu pasti komentar.</p>
                    <footer class="blockquote-footer">Selamat Riady <cite title="Source Title">2022</cite></footer>
                </blockquote>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">  
                <h4>Add Comment </h4>
                </div>
                @include('frontend._form')
            </div>
        </div>
      </div>


@endsection