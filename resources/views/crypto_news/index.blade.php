@extends('layouts.member')

@section('content')
    <style>
        .trending-card {
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .trending-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .coin-rank {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .coin-price {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .price-change {
            font-weight: bold;
        }

        .positive {
            color: #28a745;
        }

        .negative {
            color: #dc3545;
        }

        .coin-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Trending Cryptocurrencies</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trending</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @if (count($trendingCoins) > 0)
                <div class="row">
                    @foreach ($trendingCoins as $coin)
                        @php
                            $coinData = $coin['item'];
                            $priceChange = $coinData['data']['price_change_percentage_24h']['usd'] ?? 0;
                        @endphp

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card trending-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="coin-rank mr-3">#{{ $loop->iteration }}</span>
                                        <img src="{{ $coinData['thumb'] }}" alt="{{ $coinData['name'] }}"
                                            class="coin-icon mr-2">
                                        <div>
                                            <h5 class="mb-0">{{ $coinData['name'] }}
                                                ({{ strtoupper($coinData['symbol']) }})</h5>
                                            <small class="text-muted">Market Cap Rank:
                                                {{ $coinData['market_cap_rank'] ?? 'N/A' }}</small>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="coin-price">
                                                ${{ number_format($coinData['data']['price'], 4) }}
                                            </div>
                                            <div class="price-change {{ $priceChange >= 0 ? 'positive' : 'negative' }}">
                                                {{ number_format($priceChange, 2) }}%
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <div>
                                                <small class="text-muted">24h Volume:</small><br>
                                                ${{ number_format(floatval($coinData['data']['total_volume'] ?? 0), 2) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="https://www.coingecko.com/en/coins/{{ $coinData['id'] }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-footer text-center text-muted">
                                Last updated: {{ $lastUpdated }}
                                <button onclick="window.location.reload()" class="btn btn-sm btn-primary ml-2">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Currently no trending data available. Please try again later.
                </div>
            @endif
        </div>
    </div>
@endsection
