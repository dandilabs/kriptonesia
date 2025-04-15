@extends('layouts.member')

@section('content')
    <style>
        #calendar-table th {
            white-space: nowrap;
        }

        .table-responsive {
            min-height: 300px;
        }

        .badge {
            font-size: 0.85em;
            padding: 4px 6px;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kalender Ekonomi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kalender Ekonomi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Event Ekonomi Hari Ini
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="calendar-table" class="table table-bordered table-hover table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="10%">Negara</th>
                                            <th width="15%">Kategori</th>
                                            <th width="25%">Event</th>
                                            <th width="10%">Aktual</th>
                                            <th width="10%">Sebelumnya</th>
                                            <th width="10%">Perkiraan</th>
                                            <th width="5%">Penting</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item['Date'])->format('d M Y') }}<br>
                                                    <small>{{ \Carbon\Carbon::parse($item['Date'])->format('H:i') }}</small>
                                                </td>
                                                <td>
                                                    {{-- <img src="https://www.tradingeconomics.com/images/flags/{{ strtolower($item['Country'] ?? '') }}.gif"
                                                        alt="{{ $item['Country'] ?? '' }}" class="mr-2" width="20"> --}}
                                                    {{ $item['Country'] ?? '-' }}
                                                </td>
                                                <td>{{ $item['Category'] ?? '-' }}</td>
                                                <td>{{ $item['Event'] ?? '-' }}</td>
                                                <td class="{{ isset($item['Actual']) ? 'font-weight-bold' : '' }}">
                                                    {{ $item['Actual'] ?? '-' }}
                                                </td>
                                                <td>{{ $item['Previous'] ?? '-' }}</td>
                                                <td>{{ $item['Forecast'] ?? '-' }}</td>
                                                <td class="text-center">
                                                    @if ($item['Importance'] == 1)
                                                        <span class="badge badge-success">Low</span>
                                                    @elseif($item['Importance'] == 2)
                                                        <span class="badge badge-warning">Medium</span>
                                                    @elseif($item['Importance'] == 3)
                                                        <span class="badge badge-danger">High</span>
                                                    @else
                                                        <span class="badge badge-secondary">?</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fas fa-calendar-times fa-2x mb-2 text-muted"></i>
                                                    <p class="text-muted">Tidak ada data kalender ekonomi hari ini.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <small class="text-muted">
                                Data diperbarui: {{ now()->format('d F Y H:i') }}
                            </small>
                            <a href="https://tradingeconomics.com/calendar" target="_blank"
                                class="btn btn-sm btn-outline-primary float-right">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat di Trading Economics
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#calendar-table').DataTable({
                "paging": true, // Aktifkan pagination
                "lengthChange": true, // Tambahkan pilihan jumlah data per halaman
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5 // Set jumlah data default per halaman
            });
        });
    </script>
@endpush
