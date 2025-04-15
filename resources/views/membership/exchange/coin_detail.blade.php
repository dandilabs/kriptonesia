@extends('layouts.member')

@section('title', $coin['name'] . ' (' . strtoupper($coin['symbol']) . ')')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">
            <img src="{{ $coin['image']['large'] }}" alt="{{ $coin['name'] }}" width="40" class="me-2">
            {{ $coin['name'] }} <small class="text-muted">({{ strtoupper($coin['symbol']) }})</small>
        </h1>
        <div class="fw-bold fs-4 {{ $marketData['price_change_percentage_24h'] >= 0 ? 'text-success' : 'text-danger' }}">
            {{ $marketData['price_change_percentage_24h'] >= 0 ? '+' : '' }}{{ $marketData['price_change_percentage_24h'] }}%
        </div>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header h5 {
            font-weight: 600;
        }

        #priceChart {
            min-height: 300px;
        }

        .progress {
            border-radius: 100px;
            background-color: #f0f2f5;
        }

        .progress-bar {
            border-radius: 100px;
        }

        .coin-description img {
            max-width: 100%;
            height: auto;
        }

        .list-group-item {
            border: none;
            padding-left: 0;
            padding-right: 0;
        }
    </style>
    <div class="container-fluid px-0">
        <!-- Market & Price Info -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="mb-0">${{ $marketData['current_price']['usd'] }}</h2>
                                <div class="text-muted">{{ $marketData['current_price']['btc'] }} BTC</div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="small text-muted">Market Cap</div>
                                        <div class="fw-bold">${{ $marketData['market_cap']['usd'] }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small text-muted">24h Volume</div>
                                        <div class="fw-bold">{{ $marketData['volume'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Price Chart (7 Days)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="priceChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">About {{ $coin['name'] }}</h5>
                    </div>
                    <div class="card-body coin-description">
                        {!! $coin['description']['en'] ?? 'No description available.' !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Price Change</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>24h</span>
                                <span
                                    class="{{ $priceChange['24h']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $priceChange['24h']['percentage'] >= 0 ? '+' : '' }}{{ $priceChange['24h']['percentage'] }}%
                                    (${{ number_format($priceChange['24h']['change'], 2) }})
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>7d</span>
                                <span class="{{ $priceChange['7d']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $priceChange['7d']['percentage'] >= 0 ? '+' : '' }}{{ $priceChange['7d']['percentage'] }}%
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>30d</span>
                                <span
                                    class="{{ $priceChange['30d']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $priceChange['30d']['percentage'] >= 0 ? '+' : '' }}{{ $priceChange['30d']['percentage'] }}%
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">All Time High</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Price</span>
                            <span class="fw-bold">${{ $allTimeHigh['price'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Date</span>
                            <span>{{ $allTimeHigh['date'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">% From ATH</span>
                            <span class="{{ $allTimeHigh['percentage_down'] <= 0 ? 'text-danger' : 'text-success' }}">
                                {{ $allTimeHigh['percentage_down'] <= 0 ? '' : '+' }}{{ $allTimeHigh['percentage_down'] }}%
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Supply Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Circulating</span>
                            <span class="fw-bold">{{ $supplyData['circulating'] }}
                                {{ strtoupper($coin['symbol']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Supply</span>
                            <span class="fw-bold">{{ $supplyData['total'] }} {{ strtoupper($coin['symbol']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Max Supply</span>
                            <span class="fw-bold">{{ $supplyData['max'] }} {{ strtoupper($coin['symbol']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('priceChart').getContext('2d');
            const labels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Today'];
            const data = Array.from({
                length: 7
            }, () => Math.floor(Math.random() * 1000) + 1000);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Price (USD)',
                        data: data,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
