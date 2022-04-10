@extends('layouts.frontend')

@section('title', 'Blog')

@section('navbar')
    @include('frontend/components/navbar')
@endsection

@section('page_title', 'Info Blog') 

@section('content')
  <div class="row">
    @foreach ($posts as $post)
        <div class="col-12 col-md-4 col-lg-4">
        <article class="article article-style-c">
            <div class="article-header">
            <div class="article-image" data-background="{{ url($post->file_path) }}">
            </div>
            </div>
            <div class="article-details">
            <div class="article-category"><a href="#">News</a> <div class="bullet"></div> 
            <a href="#">{{ $post->created_at->toDayDateTimeString() }}</a></div>
            <div class="article-title">
                <h2><a href="{{ url('/blog/'.$post->slug) }}">{{ $post->title }}</a></h2>
            </div>
            <p>{!! Str::limit($post->body, 200) !!}</p>
            <div class="article-user">
                <div class="article-user-details">
                <div class="user-detail-name">
                    <a href="#">{{ $post->user->name }}</a>
                </div>
                <div class="text-job">{{ $post->category->name }} || {{ $post->views_count }} kali dilihat</div>
                </div>
            </div>
            </div>
        </article>
        </div>
    @endforeach
    </div>


@endsection