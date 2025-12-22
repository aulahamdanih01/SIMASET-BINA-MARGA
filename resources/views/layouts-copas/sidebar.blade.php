<aside class="main-sidebar elevation-4" style="background-color: #030F6B;">

  <style>
    /* Semua link sidebar berwarna putih */
    .sidebar .nav-link {
      color: #ffffff !important;
    }

    /* Hover / aktif */
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #1a237e !important; /* biru tua saat aktif/hover */
      color: #ffffff !important;
    }

    /* Icon di nav-link */
    .sidebar .nav-icon {
      color: #ffffff !important;
    }

    /* Submenu icon */
    .sidebar .nav-treeview .nav-icon {
      color: #ffffff !important;
    }

    /* Saat sidebar collapse, sembunyikan teks */
    body.sidebar-collapse .sidebar .sidebar-text {
      display: none;
    }

    /* Tetap tampilkan ikon */
    body.sidebar-collapse .sidebar .sidebar-header i {
      margin-right: 0; /* agar icon centering lebih rapi */
    }

  </style>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column">
    
    <!-- Header: Logo + Judul -->
    <div class="d-flex align-items-center sidebar-header pt-4 py-4 px-3">
      <i class="fas fa-file-alt fa-2x text-white mr-2"></i>
      <div class="sidebar-text">
        <h5 class="mb-0 text-white">Dashboard</h5>
        <h3 class="mb-0 text-white">
          <strong class="px-1">SiPANDAI</strong>
        </h3>
      </div>
    </div>

    <!-- Menu -->
    <nav class="mt-2 flex-grow-1">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- ASET TETAP -->
        <li class="nav-item {{ Request::routeIs('documents.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('documents.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              ASET TETAP
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Daftar Aset Tetap
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Tambah Aset Tetap
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.category.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Riwayat Aset Tetap
              </a>
            </li>
          </ul>
        </li>

        <!-- INVENTORY-->
        <li class="nav-item {{ Request::routeIs('documents.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('documents.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              INVENTORY
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Daftar Inventory
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Tambah Inventory
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.category.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> inventory Masuk
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.category.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> inventory Keluar
              </a>
            </li>
          </ul>
        </li>


        <!-- LAPORAN -->
        <li class="nav-item {{ Request::routeIs('documents.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('documents.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              LAPORAN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Aset Tetap
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.category.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Mutasi Aset
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.category.*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Kerusakan Aset
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Inventory
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Inventory Masuk
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('documents.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Laporan Inventory Keluar
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>

    <!-- Logout di bawah -->
    <ul class="nav nav-pills nav-sidebar flex-column mt-auto" role="menu">
      <li class="nav-item">
        <form method="POST" action="">
          @csrf
          <button type="submit" 
              class="nav-link d-flex align-items-center" 
              style="background-color: #FEBC2F; border: none; width: 100%;">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="d-none d-sm-inline text-white">Logout</p>
          </button>
        </form>
      </li>
    </ul>

  </div>
  <!-- /.sidebar -->
</aside>