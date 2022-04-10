@extends('layouts.frontend')

@section('title', 'Blog')

@section('navbar')
    @include('frontend/components/navbar')
@endsection

@section('page_title', ' Blog') 

@section('content')
<div class="section-body">
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
  <div class="row">
        <!-- conten 1 -->
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                <h4>Populer</h4>
                </div>
                <div class="card-body">
                  <div class="list-group">
                      @foreach ($article_populer as $item)
                        <a href="{{ url('/blog/'.$item->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start ">
                          <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">{{ $item->title }}</h5>
                              <small>{{ $item->created_at->diffForHumans() }}</small>
                          </div>
                          <p class="mb-1">{{ $item->views_count }} kali dilihat</p>
                          <small class="text-muted">{{ $item->category->name }}</small>
                        </a>
                      @endforeach
                  </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h4>Terbaru</h4>
                </div>
                <div class="card-body">
                <div class="list-group">
                  @foreach ($article_terbaru as $item)
                    <a href="{{ url('/blog/'.$item->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start ">
                      <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{ $item->title }}</h5>
                          <small>{{ $item->created_at->diffForHumans() }}</small>
                      </div>
                      <p class="mb-1">{{ $item->views_count }} kali dilihat</p>
                      <small class="text-muted">{{ $item->category->name }}</small>
                    </a>
                  @endforeach
                </div>
                </div>
            </div>
        </div>
        <!-- conten 1 end  -->
         <!-- navigasi kanan  -->
         <div class="col-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                <h4>Kategori</h4>
                </div>
                <div class="card-body">
                  <div class="list-group">
                    @foreach ($category as $item)
                      <a href="{{ url('/blog/category/'.$item->name) }}" class="list-group-item list-group-item-action {{ $item->posts_count ? '' : 'disabled' }}">
                      {{ $item->name }}<span class="badge badge-primary badge-pill">{{ $item->posts_count }}</span>
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h4>Tags</h4>
                </div>
                <div class="card-body">
                  <div class="list-group">
                    @foreach ($tags as $item)
                      <a href="{{ url('/blog/tag/'.$item->name) }}" class="list-group-item list-group-item-action {{ $item->posts_count ? '' : 'disabled' }}">
                      {{ $item->name }}<span class="badge badge-primary badge-pill">{{ $item->posts_count }}</span>
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h4>Tahun</h4>
                </div>
                <div class="card-body">
                  <div class="list-group">
                    @foreach ($archive as $item)
                        <a href="{{ url('/blog/year/'.$item->grouptahun) }}" class="list-group-item list-group-item-action {{ $item->count_row ? '' : 'disabled' }}">
                        {{ $item->grouptahun }}<span class="badge badge-primary badge-pill">{{ $item->count_row }}</span>
                          </a>
                      @endforeach
                  </div>
                </div>
            </div>
        </div>
        <!-- navigasi kanan end  -->
  </div>

 
  </div>
</div>

@endsection