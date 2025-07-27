@extends('layouts.app')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="row">

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class=" col-12 card shadow mb-4">
            <div class="card-body">
                <h5 class="font-weight-bold text-dark">Selamat Datang {{ Auth::user()->nama }}</h5>
                <hr>
                <p>Sistem Menejemen Arsip, Berikut Informasi Anda :</p>
                <ul>
                    <li>Username Anda Adalah : <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></li>
                    <li>Anda Login Sebagai : <a href="#">@if ( Auth::user()->role == 'admin' )Admin @else Operator @endif</a></li>
                </ul>
                <p>Jaga Selalu Username dan Password Anda</p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
@endsection
