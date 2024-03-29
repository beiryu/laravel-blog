@extends('layout')

@section('main')
<!-- main -->
<main class="container">
  <h2 class="header-title">All Blog Posts</h2>
  
  @include('includes.flash-message')
  <div class="searchbar">
    <form action="">
      <input type="text" placeholder="Search..." name="search" />

      <button type="submit">
        <i class="fa fa-search"></i>
      </button>

    </form>
  </div>
  <div class="categories">
    <ul>
      @foreach ($categories as $category)
      <li><a href="{{ route('blog.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
          
      @endforeach
    </ul>
  </div>
  <section class="cards-blog latest-blog">
    @forelse ($posts as $post)
    <div class="card-blog-content">
  
      <img src="{{ asset($post->imgPath) }}" alt="" />
      <p>
        <span>
          <i class="fas fa-clock"></i>
          {{ $post->created_at->diffForHumans() }}
        </span>
        

        <span>
          <i class="fas fa-user"></i>
          Written By {{ $post->user->name }}
        </span>

      </p>
      <h4>
        <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
      </h4>
    </div>
    @empty
        <p>Sorry, currently there is no blog post related to that search!</p>
    @endforelse

  </section>

  {{ $posts->links('pagination::default') }}
  
</main>

@endsection