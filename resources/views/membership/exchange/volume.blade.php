<!-- resources/views/membership/exchange/tickers.blade.php -->
@extends('layouts.member')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        @if ($exchangeLogo)
                            <img src="{{ $exchangeLogo }}" alt="{{ $exchangeName }}"
                                style="height: 30px; width: auto; margin-right: 10px;">
                        @endif
                        {{ $exchangeName }} Market Pairs
                    </h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <span class="badge badge-pill badge-dark" id="lastUpdated">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $lastUpdated }}
                        </span>
                        <a href="{{ route('exchange.volume', ['id' => $exchangeId]) }}"
                            class="btn btn-sm btn-light ml-2">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @if (isset($error))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                    {{ $error }}
                </div>
            @endif

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol mr-1"></i>
                        Trading Pairs ({{ $tickers->count() }})
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" id="tickerSearch" class="form-control float-right"
                                placeholder="Search pairs...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-valign-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Pair</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Volume (24h)</th>
                                    <th class="text-right">Spread</th>
                                    <th class="text-center">Trust</th>
                                    <th class="text-right">Last Traded</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickers as $ticker)
                                    <tr>
                                        <td>
                                            <strong>{{ $ticker['coin'] }}</strong>/{{ $ticker['pair'] }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($ticker['price'], 8) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($ticker['volume'], 2) }}
                                        </td>
                                        <td class="text-right">
                                            @if ($ticker['spread'])
                                                <span
                                                    class="{{ $ticker['spread'] < 1 ? 'text-success' : ($ticker['spread'] < 5 ? 'text-warning' : 'text-danger') }}">
                                                    {{ number_format($ticker['spread'], 2) }}%
                                                </span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($ticker['trust_score'])
                                                @php
                                                    $trustColor = match (strtolower($ticker['trust_score'])) {
                                                        'green' => 'success',
                                                        'yellow' => 'warning',
                                                        'red' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $trustColor }}">
                                                    {{ ucfirst($ticker['trust_score']) }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($ticker['last_traded_at'])
                                                {{ \Carbon\Carbon::parse($ticker['last_traded_at'])->diffForHumans() }}
                                            @else
                                                <span class="text-muted">Unknown</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ $ticker['trade_url'] }}" target="_blank"
                                                class="btn btn-sm btn-primary" title="Trade">
                                                <i class="fas fa-exchange-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            @if (isset($error))
                                                Failed to load ticker data
                                            @else
                                                No trading pairs found
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <span class="text-muted">
                            Showing page {{ $currentPage }} - {{ $tickers->count() }} pairs
                        </span>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('exchange.volume', ['id' => $exchangeId, 'page' => max(1, $currentPage - 1)]) }}"
                            class="btn btn-sm {{ $currentPage <= 1 ? 'btn-outline-secondary disabled' : 'btn-default' }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="{{ route('exchange.volume', ['id' => $exchangeId, 'page' => $currentPage + 1]) }}"
                            class="btn btn-sm {{ $tickers->count() < 100 ? 'btn-outline-secondary disabled' : 'btn-default' }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>
                Data provided by CoinGecko API. Trust score indicates the reliability of the trading pair.
                <strong>Green</strong> = High trust, <strong>Yellow</strong> = Medium, <strong>Red</strong> = Low.
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-valign-middle td {
            vertical-align: middle !important;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, .02);
        }

        .trust-badge {
            width: 70px;
            display: inline-block;
            text-align: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Search functionality
            $('#tickerSearch').keyup(function() {
                const value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Auto-refresh every 2 minutes
            setInterval(function() {
                window.location.reload();
            }, 120000);
        });
    </script>
@endpush
