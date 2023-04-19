<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="TOR keeping system">
  <meta name="author" content="Agnote ageo">
  <meta name="generator" content="Bootstrap 0.108.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('./css/Custom.css')}}" />
  <link rel="stylesheet" href="{{ asset('./css/sidebars.css')}}" />
  <link rel="stylesheet" href="{{ asset('./bs/boxicons.min.css')}}" />

  <script src="{{ asset('./bs/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('./js/popper.min.js') }}"></script>
  <script src="{{ asset('./js/jquery-3.5.1.js') }}"></script>
  <script src="{{ asset('./js/sidebars.js') }}"></script>



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>


</head>

<body>

  <main class="d-flex flex-nowrap" style="height: 100vh;">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow-lg" style="width: 280px;">
      <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="{{ asset('./img/logo.png') }}" alt="logo" height="40px" width="40px">
        <span class="fs-4 m-4">SJNHS</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">

        @if(Auth::user()->role === 0)
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->path() === 'dashboard' ? 'active' : 'link-dark' }}" aria-current="page">
            <span class="bx bx-home"></span>
            Home
          </a>
        </li>
        <li>
          <a href="{{ route('data.management') }}" class="nav-link {{ request()->path() === 'data-management' 
            || Request::is('data-management/*') ? 'active' : 'link-dark'
          }}">
            <span class="bx bx-add-to-queue"></span>
            Data management
          </a>
        </li>
        <li>
          <a href="{{ route('release') }}" class="nav-link {{ request()->path() === 'release' ? 'active' : 'link-dark' }}">
            <span class="bx bx-printer"></span>
            Release
          </a>
        </li>
        <li>
          <a href="{{ route('manage.user') }}" class="nav-link {{ request()->path() === 'manage-user' ? 'active' : 'link-dark' }}">
            <span class="bx bx-user"></span>
            Users
          </a>
        </li>
        <li>
          <a href="{{ route('report') }}" class="nav-link {{ request()->path() === 'reports' ? 'active' : 'link-dark' }}">
            <span class="bx bx-receipt"></span>
            Reports
          </a>
        </li>
        @endif


        @if(Auth::user()->role === 1)
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->path() === 'dashboard' ? 'active' : 'link-dark' }}" aria-current="page">
            <span class="bx bx-home"></span>
            Home
          </a>
        </li>
        @endif
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2"> -->
          <div class="d-flex flex-column">
            @if(Auth::user()->role === 0)
            <strong style="margin: 0;">Administrator</strong>
            @endif

            @if(Auth::user()->role === 1)
            <strong style="margin: 0;">Teacher</strong>
            @endif

            <span style="margin: 0; font-size: 10px" class="text-uppercase">{{ Auth::user()->firstname .' '. Auth::user()->lastname }}</span>
          </div>
        </a>
        <ul class="dropdown-menu text-small shadow">
          <li><a class="dropdown-item {{ Request::is('settings/*') ? 'active' : '' }} " href="{{ route('settings') }}"> <span class="bx bx-cog"></span> Settings</a> </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><button class="dropdown-item" id="btn-logout"> <span class="bx bx-log-out"></span>Sign out</button></li>
        </ul>
      </div>
    </div>

    <x-message-dialog />

    <div class="container" id="main" style="overflow-x: scroll;">
      @yield('content')
    </div>
  </main>


</body>
<script>
  function messageBox(msg) {
    $('#msgBox').modal('show')
    $('#msg-box-text').text(msg)
  }
  $(document).ready(function() {

    $('#btn-logout').click(function() {
      $('#msgBox-delete-subj').css('display', 'none')
      $('#msgBox-delete-student-info').css('display', 'none')
      $('#msgBox-delete-acads').css('display', 'none')
      $('#msgBox-btn-confirm').css('display', 'block')
      messageBox('Are you sure you want to logout now?')
    })

    $('#msgBox-btn-cancel').click(() => $('#msgBox').modal('hide'))


    $('#msgBox-btn-confirm').click(function() {

      $.ajax({
        url: "{{ route('logout') }}",
        type: 'post',
        data: {
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {
          window.location.replace(data)
        },
        error: function() {
          window.location.replace(data)
        }
      })
    })

  })
</script>

</html>