<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ url('/') }}">{{ config('app.name', 'BlogMu') }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">{{ config('app.name', 'BM') }}</a>
      </div> 
      <ul class="sidebar-menu">
          {{-- <li class="menu-header">{{ Route::currentRouteName() }}</li> --}}
          {{-- <li><a class="nav-link" href="{{ url('home') }}"><i class="far fa-fire"></i> <span>Dashboard</span></a></li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Portofolio</span></a>
            <ul class="dropdown-menu">
              <li class=""><a class="nav-link" href="{{ url('admin/posts/create') }}">Banner</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/comments') }}">About</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/comments') }}">Skill</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/posts') }}">Portofolio</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/comments') }}">Sosmed</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Article</span></a>
            <ul class="dropdown-menu">
              <li class=""><a class="nav-link" href="{{ url('admin/posts/create') }}">New Article</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/posts') }}">All Article</a></li>
              <li class=""><a class="nav-link" href="{{ url('admin/comments') }}">Comment</a></li>
            </ul>
          </li>
          <li class="menu-header">Parameter </li>
          <li><a class="nav-link" href="{{ url('admin/menus') }}"><i class="far fa-fire"></i> <span>Menu</span></a></li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Parameter Article</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ url('admin/tags') }}">Tags</a></li>
              <li><a class="nav-link" href="{{ url('admin/categories') }}">Category</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Parameter Portofolio</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ url('admin/tags') }}">Tags</a></li>
              <li><a class="nav-link" href="{{ url('admin/categories') }}">Category</a></li>
            </ul>
          </li> --}}

          
          {{-- @php
          dd(App\MenuData::with('menu')->Grouped()->get());
          @endphp --}}
          {{-- @foreach (App\Menus::orderBy('sort','asc')->get() as $menuItem) --}}
          @foreach (App\MenuData::with('menu')->Grouped()->get() as $menuItem)
          
            @if( $menuItem->menu->parent_id == 0 )
             {{-- @if(!$menuItem->children->isEmpty())
             <li class="menu-header">{{$menuItem->title}} </li>
             @endif --}}
              <li {{ $menuItem->menu->link ? '' : "class=nav-item dropdown" }} class="{{ (request()->is($menuItem->menu->link.'*')) ? 'active' : '' }}">
              <a href="{{ $menuItem->menu->children->isEmpty() ? url($menuItem->menu->link) : "#" }}"
                class="nav-link {{ $menuItem->menu->children->isEmpty() ? '' : 'has-dropdown' }}"
                data-toggle="{{ $menuItem->menu->children->isEmpty() ? '' : 'dropdown' }}">
                  <i class="fas fa-columns"></i> 
                  <span>{{ $menuItem->menu->title }}</span>
              </a>
            @endif

            @if( ! $menuItem->menu->children->isEmpty() )
              <ul class="dropdown-menu">
                @foreach($menuItem->menu->children as $subMenuItem)
                    <li><a class="nav-link {{ (request()->is($subMenuItem->link.'*')) ? 'active' : '' }}" href="{{ url($subMenuItem->link) }}">{{ $subMenuItem->title }}</a></li>
                @endforeach
              </ul>
            @endif
            
          @endforeach
    </aside>
  </div>