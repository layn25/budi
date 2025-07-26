<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      {{-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div> --}}
      <div class="sidebar-brand-text mx-3">Apa Bagus</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Nav::isRoute('home') }}">
      <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{ __('Dashboard') }}</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      {{ __('Settings') }}
  </div>

  @if (Auth::user()->role == 'admin')
  <!-- Nav Item - Profile -->
  <li class="nav-item {{ Nav::isRoute('pengguna') }}">
      <a class="nav-link" href="{{ route('pengguna') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>{{ __('Pengguna') }}</span>
      </a>
  </li>
  <li class="nav-item {{ Nav::isRoute('kegiatan') }}">
      <a class="nav-link" href="{{ route('kegiatan') }}">
          <i class="fas fa-fw fa-boxes"></i>
          <span>{{ __('Kegiatan') }}</span>
      </a>
  </li>
  <li class="nav-item {{ Nav::isRoute('keuangan') }}">
      <a class="nav-link" href="{{ route('keuangan') }}">
          <i class="fas fa-fw fa-boxes"></i>
          <span>{{ __('Keuangan') }}</span>
      </a>
  </li>
  <li class="nav-item {{ Nav::isRoute('anggota') }}">
      <a class="nav-link" href="{{ route('anggota') }}">
          <i class="fas fa-fw fa-boxes"></i>
          <span>{{ __('Anggota') }}</span>
      </a>
  </li>
  @endif
  <!-- Nav Item - Product -->
  


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>