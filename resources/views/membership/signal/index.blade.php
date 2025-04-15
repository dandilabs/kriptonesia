@extends('layouts.member')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Trade Signals</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @include('sweetalert::alert')

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Available Trade Signals</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="signals-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Symbol</th>
                                <th>Type</th>
                                <th>Jenis Trade</th>
                                <th>Entry</th>
                                <th>Target</th>
                                <th>Stop Loss</th>
                                <th>Expires</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $item->symbol }}</strong><br><small>{{ $item->name }}</small></td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $item->type === 'buy' || $item->type === 'strong_buy' ? 'success' : 'danger' }}">
                                            {{ strtoupper(str_replace('_', ' ', $item->type)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->trade_type === 'future')
                                            <span class="badge badge-warning">FUTURE
                                                {{ $item->leverage ? "({$item->leverage}X)" : '' }}</span>
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
                                    <td>
                                        <a href="{{ route('trade.show', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#signals-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [6, 'asc']
                ]
            });
        });
    </script>
@endpush
