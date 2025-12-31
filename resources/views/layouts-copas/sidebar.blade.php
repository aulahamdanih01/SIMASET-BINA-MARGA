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
        <li class="nav-header" style="color: white;">MENU</li>

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>


        <!-- DATA MASTER -->
        <li class="nav-item {{ Request::routeIs('master.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('master.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Data Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('master.pic.index') }}" class="nav-link {{ Request::routeIs('master.pic.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Penanggung Jawab Aset
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('master.categories.index') }}" class="nav-link {{ Request::routeIs('master.categories.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Kategori Aset
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('master.conditions.index') }}" class="nav-link {{ Request::routeIs('master.conditions.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Kondisi Aset
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('master.units.index') }}" class="nav-link {{ Request::routeIs('master.units.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Satuan Barang
              </a>
            </li>
          </ul>
        </li>

        <!-- ASET TETAP -->
        <li class="nav-item">
          <a href="" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>Aset Tetap</p>
          </a>
        </li>

        <!-- INVENTORY -->
        <li class="nav-item">
          <a href="{{route('inventories.index')}}" class="nav-link {{ Request::routeIs('inventories.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>Inventory</p>
          </a>
        </li>

        <!-- TRANSAKSI -->
        <li class="nav-item {{ Request::routeIs('master.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('master.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Transaksi Inventori
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('master.pic.index') }}" class="nav-link {{ Request::routeIs('master.pic.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Transaksi Masuk
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('master.categories.index') }}" class="nav-link {{ Request::routeIs('master.categories.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Transaksi Keluar
              </a>
            </li>
          </ul>
        </li>

        <!-- LAPORAN -->
        <li class="nav-item {{ Request::routeIs('laporan.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::routeIs('laporan.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <!-- LAPORAN ASET -->
            <li class="nav-item {{ Request::routeIs('laporan.aset.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::routeIs('laporan.aset.*') ? 'active' : '' }}">
                <!-- icon dihilangkan -->
                <i></i>
                <p>
                  Laporan Aset Tetap
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link {{ Request::routeIs('laporan.aset.mutasi') ? 'active' : '' }}">
                    <i></i>
                    <p>Laporan Mutasi Aset</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="" class="nav-link {{ Request::routeIs('laporan.aset.kerusakan') ? 'active' : '' }}">
                    <i></i>
                    <p>Laporan Kerusakan Aset</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="" class="nav-link {{ Request::routeIs('laporan.aset.penghapusan') ? 'active' : '' }}">
                    <i></i>
                    <p>Laporan Penghapusan Aset</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- LAPORAN INVENTORY -->
            <li class="nav-item {{ Request::routeIs('laporan.inventory.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::routeIs('laporan.inventory.*') ? 'active' : '' }}">
                <i></i>
                <p>
                  Laporan Inventory
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i></i>
                    <p>Laporan Inventory Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i></i>
                    <p>Laporan Inventory Keluar</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </li>

      </ul>
    </nav>

    <!-- Logout di bawah -->
    <ul class="nav nav-pills nav-sidebar flex-column mt-auto" role="menu">
      <li class="nav-header" style="color: white;">OTHER</li>
      <li class="nav-item">
        <a href="{{ route('profile.edit') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
          <i class="nav- fas fa-user"></i>
          <p>Profil</p>
        </a>
      </li>
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