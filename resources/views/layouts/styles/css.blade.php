<!-- Fonts -->
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

{{-- DataTables --}}
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Favicon -->
<link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

{{-- css tambahan --}}
<style>
    table {
        width: 100% !important; /* Tabel selalu penuh */
        table-layout: auto; /* Biarkan browser atur lebar kolom */
        border-collapse: collapse;
    }

    th, td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
        white-space: nowrap; /* Kolom default tidak membungkus */
    }

    td.deskripsi-col {
        max-width: 300px;
        white-space: normal !important; /* Boleh membungkus */
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
</style>
