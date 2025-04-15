@extends('layouts.member')

@section('title', 'Crypto Market Insights')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">Crypto Market Insights</h1>
        <small class="text-muted">Data updates every 5 minutes</small>
    </div>
@stop

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
<style>
    .card {
        border-radius: 12px;
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }
    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
    }
    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        font-weight: 600;
    }
</style>
    <div class="container-fluid px-0">
        <!-- Market Overview Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 bg-gradient-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Top Market Cap</h5>
                        <p class="card-text">Leading cryptocurrencies by valuation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Top Gainers</h5>
                        <p class="card-text">Best 24h performers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 bg-gradient-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Top Losers</h5>
                        <p class="card-text">Worst 24h performers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Top Volume</h5>
                        <p class="card-text">Highest trading activity</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Market Dominance Chart -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Market Dominance</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="dominanceChart" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            @foreach($marketDominance as $symbol => $percentage)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary me-2">{{ strtoupper($symbol) }}</span>
                                <div class="w-100">
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ $percentage }}%;"
                                             aria-valuenow="{{ $percentage }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <span class="ms-2 fw-bold">{{ $percentage }}%</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Coins Section -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Top 10 Cryptocurrencies by Market Cap</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40px">#</th>
                                <th>Coin</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">24h Change</th>
                                <th class="text-end">Market Cap</th>
                                <th class="text-end">24h Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topCoins as $coin)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" width="24" class="me-2">
                                        <div>
                                            <a href="{{ route('crypto.show', $coin['id']) }}" class="fw-bold text-decoration-none">
                                                {{ $coin['name'] }}
                                            </a>
                                            <div class="text-muted small">{{ strtoupper($coin['symbol']) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">${{ number_format($coin['current_price'], 2) }}</td>
                                <td class="text-end">
                                    <span class="badge bg-{{ $coin['price_change_percentage_24h'] >= 0 ? 'success' : 'danger' }}">
                                        {{ $coin['price_change_percentage_24h'] >= 0 ? '+' : '' }}{{ number_format($coin['price_change_percentage_24h'], 2) }}%
                                    </span>
                                </td>
                                <td class="text-end">${{ number_format($coin['market_cap'] / 1000000000, 2) }}B</td>
                                <td class="text-end">${{ number_format($coin['total_volume'] / 1000000, 2) }}M</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Performance Sections -->
        <div class="row">
            <!-- Top Gainers -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 text-success">Top Gainers (24h)</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($topGainers as $coin)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" width="24" class="me-2">
                                        <a href="{{ route('crypto.show', $coin['id']) }}" class="text-decoration-none fw-bold">
                                            {{ $coin['name'] }}
                                        </a>
                                    </div>
                                    <span class="badge bg-success">{{ number_format($coin['price_change_percentage_24h'], 2) }}%</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Top Losers -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 text-danger">Top Losers (24h)</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($topLosers as $coin)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" width="24" class="me-2">
                                        <a href="{{ route('crypto.show', $coin['id']) }}" class="text-decoration-none fw-bold">
                                            {{ $coin['name'] }}
                                        </a>
                                    </div>
                                    <span class="badge bg-danger">{{ number_format($coin['price_change_percentage_24h'], 2) }}%</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Top Volume -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 text-primary">Top Volume (24h)</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($topVolume as $coin)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" width="24" class="me-2">
                                        <span class="fw-bold">{{ $coin['name'] }}</span>
                                    </div>
                                    <span class="badge bg-primary">${{ number_format($coin['total_volume'] / 1000000, 2) }}M</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    // Market Dominance Chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('dominanceChart').getContext('2d');
        const dominanceData = {
            labels: {!! json_encode(array_keys($marketDominance->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($marketDominance->toArray())) !!},
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e',
                    '#e74a3b'
                ],
                borderWidth: 0
            }]
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: dominanceData,
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush
