@extends('layouts.admin')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trade Signals</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Trade Signals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            @include('sweetalert::alert')

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i>Latest Trading Signals
                            </h3>
                            @if (auth()->user()->isAdmin())
                                <div class="card-tools">
                                    <a href="{{ route('signal-trade.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Create New
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="signals-table" class="table table-bordered table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Symbol</th>
                                            <th>Type</th>
                                            <th>Jenis Trade</th>
                                            <th>Entry Price</th>
                                            <th>Target</th>
                                            <th>Stop Loss</th>
                                            <th>Expires In</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $item->symbol }}</strong><br>
                                                    <small>{{ $item->name }}</small>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->type === 'buy' || $item->type === 'strong_buy' ? 'success' : 'danger' }}">
                                                        {{ strtoupper(str_replace('_', ' ', $item->type)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->trade_type === 'future')
                                                        <span class="badge badge-warning">FUTURE
                                                            @if ($item->leverage)
                                                                ({{ $item->leverage }}X)
                                                            @endif
                                                        </span>
                                                    @else
                                                        <span class="badge badge-info">SPOT</span>
                                                    @endif
                                                </td>
                                                <td>$ {{ number_format($item->entry_price) }}</td>
                                                <td>$ {{ number_format($item->target_price) }}</td>
                                                <td>$ {{ number_format($item->stop_loss) }}</td>
                                                <td>
                                                    @if ($item->expired_at->isFuture())
                                                        {{ $item->expired_at->diffForHumans() }}
                                                    @else
                                                        <span class="text-danger">Expired</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('signal-trade.show', $item->id) }}"
                                                        class="btn btn-sm btn-info" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if (auth()->user()->isAdmin())
                                                        <a href="{{ route('signal-trade.edit', $item->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .badge-strong-buy {
            background-color: #28a745;
            color: white;
        }

        .badge-buy {
            background-color: #5cb85c;
            color: white;
        }

        .badge-strong-sell {
            background-color: #dc3545;
            color: white;
        }

        .badge-sell {
            background-color: #d9534f;
            color: white;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            $('#signals-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [
                    [6, 'asc']
                ], // Urutkan berdasarkan waktu kadaluarsa
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 7]
                    } // Kolom aksi tidak bisa diurutkan
                ]
            });
        });
    </script>
@endpush
