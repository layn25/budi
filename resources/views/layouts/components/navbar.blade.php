<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 sticky-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifikasi Stok Menipis -->
        <li class="nav-item dropdown no-arrow">
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="stokDropdown">
                <h6 class="dropdown-header">
                    Stok Menipis
                </h6>

                @forelse ($stokMenipis as $barang)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('barang.stok-menipis') }}#barang-{{ $barang->id }}">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-box text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $barang->kategori ?? 'Tanpa Kategori' }}</div>
                            <span class="font-weight-bold">{{ $barang->name }} ({{ $barang->jumlah }})</span>
                        </div>
                    </a>
                @empty
                    <span class="dropdown-item text-center text-muted small">Tidak ada stok menipis</span>
                @endforelse
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/users.png') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Keluar') }}
                </a>
            </div>
        </li>

    </ul>

</nav>