
  <nav class="navbar navbar-expand-lg main-navbar">
    <a href="index.html" class="navbar-brand sidebar-gone-hide">{{ config('app.name', 'Laravel') }}</a>
    <div class="navbar-nav">
      <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <div class="nav-collapse">
      <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
        <i class="fas fa-ellipsis-v"></i>
      </a>
      <ul class="navbar-nav">
        <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
        <li class="nav-item {{ (request()->is('blog*')) ? 'active' : '' }}"><a href="{{ url('blog') }}" class="nav-link">Blog</a></li>
        <li class="nav-item {{ (request()->is('about*')) ? 'active' : '' }}"><a href="{{ url('about') }}" class="nav-link">About</a></li>
      </ul>
    </div>
    <form class="form-inline ml-auto">
      <ul class="navbar-nav">
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        <div class="search-backdrop"></div>
        <div class="search-result">
          <div class="search-header">
            Category
          </div>
          @foreach (App\Category::select('name')->withCount('posts')->get() as $item)
            <div class="search-item">
              <a href="{{ url('/blog/category/'.$item->name) }}">{{ $item->name }}</a>
              <a href="{{ url('/blog/category/'.$item->name) }}" class="search-close"><i class="fas fa-times"></i></a>
            </div>
          @endforeach
          <div class="search-header">
            Tag
          </div>
          @foreach (App\Tag::select('name')->withCount('posts')->get() as $item)
            <div class="search-item">
              <a href="{{ url('/blog/tag/'.$item->name) }}">
                <img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
                {{ $item->name }}
              </a>
            </div>
          @endforeach
          <div class="search-header">
            Article Populer
          </div>
          @foreach (App\Post::with(['tags:name', 'category', 'user'] )
          ->withCount('comments')
          ->withCount('views')
          ->orderBy( 'views_count', 'DESC')
          ->published()
          ->limit(5)->get() as $item)
            <div class="search-item">
              <a href="{{ url('/blog/'.$item->slug) }}">
                <div class="search-icon bg-danger text-white mr-3">
                  <i class="fas fa-code"></i>
                </div>
                {{ $item->title }}
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </form>
    <ul class="navbar-nav navbar-right">
      @if (Auth::user())
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
              onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @else
                <li class="nav-item"><a href="{{ url('/login') }}" class="nav-link">Login</a></li>
        @endif
    </ul>
  </nav>

  <nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
      <ul class="navbar-nav">
        @if( (request()->is('blog*')) )
        <li class="nav-item dropdown {{ (request()->is('blog/category*')) ? 'active' : '' }}">
          <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><span>Laravel</span></a>
          <ul class="dropdown-menu">
            <li class="nav-item"><a href="index-0.html" class="nav-link">API</a></li>
            <li class="nav-item"><a href="index.html" class="nav-link">Laravel x React</a></li>
          </ul>
        </li>
        @elseif( (request()->is('/*')) )
        <li class="nav-item {{ (request()->is('ebook*')) ? 'active' : '' }}">
          <a href="#" class="nav-link"><span>E-book</span></a>
        </li>
        <li class="nav-item {{ (request()->is('portofolio*')) ? 'active' : '' }}">
          <a href="#" class="nav-link"><span>Portofolio</span></a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link"><span>Home</span></a>
        </li>
        @endif
      </ul>
    </div>
  </nav>