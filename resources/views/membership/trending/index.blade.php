@extends('layouts.member')

@section('title', 'Trending Cryptocurrencies')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">
            <i class="fas fa-chart-line text-gradient mr-2"></i>
            Trending Cryptocurrencies
        </h1>
        <span class="badge badge-light">
            <i class="far fa-clock text-muted mr-1"></i>
            Updated: {{ $lastUpdated }}
        </span>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card-elegant {
            border-radius: 12px;
            border: none;
        }

        .text-gradient {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .symbol-container {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .symbol-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1px solid #f0f0f0;
        }

        .rank-badge {
            display: inline-block;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .hover-effect:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        #trendingTable thead th {
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 15px;
            border: 1px solid #dee2e6;
        }

        .badge-light {
            background-color: #f8f9fa;
            color: #495057;
        }
    </style>
    <div class="container-fluid">
        <div class="card card-elegant shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-fire text-warning mr-2"></i>
                    Top Trending Coins
                </h5>
            </div>

            <div class="card-body px-0 py-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="trendingTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-top-0 text-center" style="width: 5%">#</th>
                                <th class="border-top-0" style="width: 35%">Coin</th>
                                <th class="border-top-0 text-center" style="width: 15%">Symbol</th>
                                <th class="border-top-0 text-right" style="width: 20%">Price (BTC)</th>
                                <th class="border-top-0 text-center" style="width: 15%">Rank</th>
                                <th class="border-top-0 text-center" style="width: 10%">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trending as $item)
                                @php
                                    $coin = $item['item'];
                                    $score = $coin['score'] + 1;
                                    $scoreClass =
                                        $score > 80
                                            ? 'success'
                                            : ($score > 60
                                                ? 'primary'
                                                : ($score > 40
                                                    ? 'warning'
                                                    : 'danger'));
                                @endphp
                                <tr class="hover-effect">
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol-container mr-3">
                                                <img src="{{ $coin['thumb'] }}" alt="{{ $coin['name'] }}"
                                                    class="symbol-img rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold">{{ $coin['name'] }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-exchange-alt fa-xs mr-1"></i>
                                                    {{ strtoupper($coin['symbol']) }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-light">
                                            {{ strtoupper($coin['symbol']) }}
                                        </span>
                                    </td>
                                    <td class="text-right font-weight-bold text-primary">
                                        {{ number_format($coin['price_btc'], 8) }} BTC
                                    </td>
                                    <td class="text-center">
                                        @if (isset($coin['market_cap_rank']))
                                            <span class="rank-badge">
                                                #{{ $coin['market_cap_rank'] }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $scoreClass }} rounded-pill">
                                            {{ $score }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
