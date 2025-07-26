@extends('layouts.app')

@section('main-content')
    
    <h2>Hasil Peramalan untuk Barang: <strong>{{ $barang->name }}</strong></h2>
    <p><strong>MAPE:</strong> {{ round($MAPE, 2) }}%</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Hasil Ramalan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ramalanBaru as $row)
                <tr>
                    <td>{{ $row['periode'] }}</td>
                    <td>{{ $row['hasil'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('peramalan.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Peramalan</a>

@endsection