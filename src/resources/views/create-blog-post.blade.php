@extends('layout')

@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 5px; ">
                Create New Post
            </h1>

            <div class="contact-form">
                <form action="" method="">
                  <!-- Title -->
                  <label for="title"><span>Title</span></label>
                  <input type="text" id="title" name="title" />
        
                  <!-- Image -->
                  <label for="image"><span>Image</span></label>
                  <input type="file" id="image" name="image" />
        
                  <!-- Content -->
                  <label for="content"><span>Content</span></label>
                    <textarea name="content" id="content"></textarea>
                   <!-- Button -->
                  <input type="submit" value="Submit" />
                </form>
              </div>
        </section>

    </main>
@endsection