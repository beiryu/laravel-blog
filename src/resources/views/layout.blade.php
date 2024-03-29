<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Beiryu Blog</title>

    <link rel = "icon" href="{{ asset('images/logo.png') }}"
        type = "image/x-icon">
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- Font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    @yield('head')
  </head>
  <body>
    <div id="wrapper">
      <!-- header -->
      @yield('header')

      <!-- sidebar -->
      <div class="sidebar">
        <span class="closeButton">&times;</span>
        <a href="{{ url('/') }}">
          <img src="{{ asset('images/logo-3.png') }}" alt="" style="width: 50%; display: block;
          margin: 40px auto 0px auto;
          ">

        </a>
        <p class="brand-title"><a href="{{ url('/') }}">Beiryu Blog</a></p>

        <div class="side-links">
          <ul>
            <li><a class="{{ Request::routeIs('welcome.index') ? 'active' : '' }}" href="{{ route('welcome.index') }}">Home</a></li>
            <li><a class="{{ Request::routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
            <li><a class="{{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
            <li><a class="{{ Request::routeIs('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a></li>
            @guest
            <li><a class="{{ Request::routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
            <li><a class="{{ Request::routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a></li>

            @endguest
            @auth
            <li><a class="{{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                
            @endauth
          </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href="https://www.facebook.com/khanhjj.dinh/"><i class="fab fa-facebook-f"></i></a>
            <a href="https://github.com/beiryu"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com/channel/UC55YrvKk2yQ3w5HYZ8w-VZA"><i class="fab fa-youtube"></i></a>
            <a href="https://www.linkedin.com/in/khanh-ndinh/"><i class="fab fa-linkedin-in"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
            
            {{-- font toi font sang --}}
          </div>

          <small>&copy 2022 BEIRYUBLOG</small>
        </footer>
      </div>
      <!-- Menu Button -->
      <div class="menuButton">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      @yield('main')

      <!-- Main footer -->
      <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
        <small>&copy 2022 BEIRYUBLOG</small>
      </footer>
    </div>

    <!-- Click events to menu and close buttons using javaascript-->
    <script>
      document
        .querySelector(".menuButton")
        .addEventListener("click", function () {
          document.querySelector(".sidebar").style.width = "100%";
          document.querySelector(".sidebar").style.zIndex = "5";
        });

      document
        .querySelector(".closeButton")
        .addEventListener("click", function () {
          document.querySelector(".sidebar").style.width = "0";
        });
    </script>
    @yield('scripts')
  </body>
</html>
