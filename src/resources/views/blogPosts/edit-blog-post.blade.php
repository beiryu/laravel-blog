@extends('layout')

@section('head')
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    
@endsection

@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 5px; ">
                Edit Post
            </h1>
            @include('includes.flash-message')

            <div class="contact-form">
                <form action="{{ route('blog.update', $post) }}" method="post" enctype="multipart/form-data">
                @method('put') 
                @csrf
                  <!-- Title -->
                  <label for="title"><span>Title</span></label>
                  <input type="text" id="title" name="title" value="{{ $post->title }}"/>
                  @error('title')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror
                  <!-- Image -->
                  <label for="image"><span>Image</span></label>
                  <input type="file" id="image" name="image" />
                  @error('image')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror
                  <!-- Content -->
                  <label for="content"><span>Content</span></label>
                  <textarea name="content" id="content">{{ $post->content }}</textarea>
                  @error('content')
                    <p style="color: red; margin-bottom: 25px; ">{{ $message }}</p>
                  @enderror
                   <!-- Button -->
                  <input type="submit" value="Submit" />
                </form>
              </div>
        </section>

    </main>
@endsection

@section('scripts')
<script>
  CKEDITOR.replace( 'content' );
</script>
@endsection