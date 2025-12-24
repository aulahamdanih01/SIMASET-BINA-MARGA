<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
  <!-- Left navbar -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar (User Info) -->
  <ul class="navbar-nav ml-auto">
    @if(Auth::check())
    <li class="nav-item dropdown">
      <div class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        {{-- <!-- Avatar kecil -->
        <img src="{{ asset('images/default-avatar.png') }}" 
             class="rounded-circle mr-2" 
             alt="User Avatar" 
             width="32" height="32"> --}}
        <!-- Info -->
        <div class="d-none d-md-block text-left" style="line-height: 1.2;">
          <span class="font-weight-bold">{{ Auth::user()->name }}</span><br>
          <small class="text-muted">{{ Auth::user()->role}}</small>
        </div>
      </div>
    @else
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    @endif
  </ul>
</nav>