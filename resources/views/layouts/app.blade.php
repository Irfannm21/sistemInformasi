<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistem Informasi Universitas ILKOOM</title>
  <link rel="icon" href="img/favicon.png" type="image/png">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light
bg-white py-3">
  <div class="container pb-3">
    <a class="navbar-brand" href="{{ url('/') }}">
      <span class="d-none" >ILKOOM</span>
      <img src="/img/ilkoom_logo.png"
      class="main-logo d-none d-xl-inline" alt="ilkoom logo">
      <img src="/img/ilkoom_logo.png" class="small-logo d-inline d-xl-none"
      alt="ilkoom logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav m-auto">
        <li class="nav-item ">
        <a class="nav-link px-4" href="{{ route('jurusans.index') }}">
            Jurusan</a>
        </li>
        <li class="nav-item">
        <a class="nav-link px-4" href="{{ route('dosens.index') }}">
            Dosen</a>
        </li>
        <li class="nav-item">
        <a class="nav-link px-4" href="{{ route('mahasiswas.index') }}">
            Mahasiswa</a>
        </li>
        <li class="nav-item">
        <a class="nav-link px-4" href="{{ route('matakuliahs.index') }}">
            MataKuliah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-4" href="{{ url('/pencarian')  }}">Search</a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link px-4" href="{{ route('login') }}">
              {{ __('Login') }}</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle px-4"
            href="#" role="button" data-toggle="dropdown" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item px-4" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}"
                method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-3" style="min-height:550px">
  <div class="row">
    <div class="col-12">

      @yield('content')

    </div>
  </div>
</div>

<!-- FOOTER -->
<footer id="main-footer" class="text-white bg-dark py-4 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3 text-center text-md-left">
        <a href="{{ url('/') }}">
          <img src="/img/ilkoom_logo_black.png" style="max-height: 60px;"
          class="mb-3 img-fluid">
        </a>
        <p>Lorem ipsum dolor sit amet veniam consectetur adipisicing elit.
          Aperiam cumque, esse modi maxime.
        </p>
      </div>
      <div class="col-md-3 text-center d-none d-md-inline">
        <h5>Information</h5>
        <ul class="list-unstyled">
          <li><a href="{{ route('jurusans.index') }}" class="text-white">
              Jurusan</a></li>
          <li><a href="{{ route('dosens.index') }}" class="text-white">
              Dosen</a></li>
          <li><a href="{{ route('mahasiswas.index') }}" class="text-white">
              Mahasiswa</a></li>
          <li><a href="{{ route('matakuliahs.index') }}" class="text-white">
              Mata Kuliah</a></li>
        </ul>
      </div>
      <div class="col-md-3 text-center">
        <h5>Our Services</h5>
        <ul class="list-unstyled">
          @guest
          @if (Route::has('register'))
            <li>
              <a class="text-white" href="{{ route('register') }}">
                {{ __('Register') }}
              </a>
            </li>
          @endif
          @endguest
          <li><a href="#" class="text-white">Help/Contact Us</a></li>
          <li><a href="#" class="text-white">Privacy Policy</a></li>
          <li><a href="#" class="text-white">Terms & Conditions</a></li>
        </ul>
      </div>
      <div class="col-md-3 text-center text-md-left">
        <h5>Hubungi Kami</h5>
        <div class="text-nowrap"><i class="fas fa-envelope fa-fw mr-3"></i>
          info@ilkoom.ac.id</div>
        <div class="text-nowrap"><i class="fas fa-phone fa-fw mr-3"></i>
          (021) 123456</div>
        <div class="text-nowrap"><i class="fas fa-globe fa-fw mr-3"></i>
          www.ilkoom.ac.id</div>
      </div>
    </div>
    <div class="row mt-3 mt-md-0">
      <div class="col-md-3 mr-md-auto text-center text-md-left">
        <small>&copy; ILKOOM {{date("Y")}}</small>
      </div>
      <div id="footer-icon" class="col-md-3 text-center text-md-left">
        <div>
          <a href="#" class="text-white mr-1">
            <i class="fab fa-facebook fa-lg"></i>
          </a>
          <a href="#" class="text-white mr-1">
            <i class="fab fa-twitter fa-lg"></i>
          </a>
          <a href="#" class="text-white mr-1">
            <i class="fab fa-instagram fa-lg"></i>
          </a>
          <a href="#" class="text-white mr-1">
            <i class="fab fa-google-plus fa-lg"></i>
          </a>
          <a href="#" class="text-white mr-1">
            <i class="fab fa-github fa-lg"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
@include('sweetalert::alert')
</body>
</html>
