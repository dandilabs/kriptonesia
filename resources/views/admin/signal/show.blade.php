@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Signal Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('signal-trade.index') }}">Signals</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $signal_trade->name }}</h3>
                            <div class="card-tools">
                                <span
                                    class="badge badge-{{ $signal_trade->type === 'buy' || $signal_trade->type === 'strong_buy' ? 'success' : 'danger' }}">
                                    {{ strtoupper(str_replace('_', ' ', $signal_trade->type)) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <h5><i class="fas fa-exchange-alt"></i> Jenis Trade</h5>
                                    <p>
                                        @if($signal_trade->trade_type === 'future')
                                            <span class="badge badge-warning">FUTURES
                                                @if($signal_trade->leverage)
                                                    ({{ $signal_trade->leverage }}X Leverage)
                                                @endif
                                            </span>
                                        @else
                                            <span class="badge badge-info">SPOT</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <h5><i class="fas fa-coins"></i> Symbol</h5>
                                    <p>{{ $signal_trade->symbol }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5><i class="fas fa-tag"></i> Entry Price</h5>
                                    <p>{{ number_format($signal_trade->entry_price,) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5><i class="fas fa-hourglass-end"></i> Expires</h5>
                                    <p>{{ $signal_trade->expired_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5><i class="fas fa-bullseye"></i> Target Price</h5>
                                    <p class="text-success">{{ number_format($signal_trade->target_price,) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><i class="fas fa-shield-alt"></i> Stop Loss</h5>
                                    <p class="text-danger">{{ number_format($signal_trade->stop_loss,) }}</p>
                                </div>
                            </div>

                            <h5><i class="fas fa-chart-bar"></i> Analysis</h5>
                            <div class="analysis-content p-3 bg-light rounded">
                                {!! $signal_trade->analysis !!}
                            </div>

                            @if ($signal_trade->image)
                                <div class="mt-4">
                                    <h5><i class="fas fa-image"></i> Chart</h5>
                                    <img src="{{ asset($signal_trade->image) }}" alt="Trade Chart"
                                        class="img-fluid rounded">
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('signal-trade.index') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Stats</h3>
                        </div>
                        <div class="card-body">
                            <div class="info-box mb-3 bg-light">
                                <span class="info-box-icon bg-info"><i class="fas fa-percentage"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Potential Gain</span>
                                    <span class="info-box-number">
                                        {{ number_format((($signal_trade->target_price - $signal_trade->entry_price) / $signal_trade->entry_price) * 100, 2) }}%
                                    </span>
                                </div>
                            </div>

                            <div class="info-box mb-3 bg-light">
                                <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Potential Loss</span>
                                    <span class="info-box-number">
                                        {{ number_format((($signal_trade->stop_loss - $signal_trade->entry_price) / $signal_trade->entry_price) * 100, 2) }}%
                                    </span>
                                </div>
                            </div>

                            <div class="info-box mb-3 bg-light">
                                <span class="info-box-icon bg-warning"><i class="fas fa-balance-scale"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Risk/Reward Ratio</span>
                                    <span class="info-box-number">
                                        @php
                                            $reward = $signal_trade->target_price - $signal_trade->entry_price;
                                            $risk = $signal_trade->entry_price - $signal_trade->stop_loss;
                                            echo number_format($reward / $risk, 2);
                                        @endphp
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
