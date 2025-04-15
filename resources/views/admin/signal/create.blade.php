@extends('layouts.admin')
@section('content')
    @include('sweetalert::alert')
    <style>
        .custom-file-label::after {
            content: "Pilih";
        }

        .invalid-feedback {
            display: block;
        }
    </style>
    <!-- Header Konten -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Signal Baru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('signal-trade.index') }}">Daftar Signal</a></li>
                        <li class="breadcrumb-item active">Tambah Signal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i>Form Signal Trading
                            </h3>
                        </div>
                        <form method="post" action="{{ route('signal-trade.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Signal *</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Contoh: Signal BTC Breakout">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="symbol">Pair Trading *</label>
                                            <input type="text" name="symbol"
                                                class="form-control @error('symbol') is-invalid @enderror"
                                                value="{{ old('symbol') }}" placeholder="Contoh: BTC/USDT">
                                            @error('symbol')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Jenis Signal *</label>
                                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                                <option value="">-- Pilih Jenis --</option>
                                                <option value="buy" {{ old('type') == 'buy' ? 'selected' : '' }}>Buy
                                                    (Beli)</option>
                                                <option value="sell" {{ old('type') == 'sell' ? 'selected' : '' }}>Sell
                                                    (Jual)</option>
                                                <option value="strong_buy"
                                                    {{ old('type') == 'strong_buy' ? 'selected' : '' }}>Strong Buy (Beli
                                                    Kuat)</option>
                                                <option value="strong_sell"
                                                    {{ old('type') == 'strong_sell' ? 'selected' : '' }}>Strong Sell (Jual
                                                    Kuat)</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="trade_type">Jenis Trade *</label>
                                            <select name="trade_type"
                                                class="form-control @error('trade_type') is-invalid @enderror"
                                                id="tradeTypeSelect">
                                                <option value="spot"
                                                    {{ old('trade_type', $signal_trade->trade_type ?? 'spot') == 'spot' ? 'selected' : '' }}>
                                                    Spot Trading</option>
                                                <option value="future"
                                                    {{ old('trade_type', $signal_trade->trade_type ?? 'spot') == 'future' ? 'selected' : '' }}>
                                                    Futures Trading</option>
                                            </select>
                                            @error('trade_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="leverageField"
                                            style="{{ old('trade_type', $signal_trade->trade_type ?? 'spot') == 'future' ? '' : 'display:none;' }}">
                                            <label for="leverage">Leverage (X)</label>
                                            <input type="number" step="0.01" name="leverage"
                                                value="{{ old('leverage', $signal_trade->leverage ?? '') }}"
                                                class="form-control @error('leverage') is-invalid @enderror"
                                                placeholder="Contoh: 10.00">
                                            @error('leverage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="entry_price">Harga Entry *</label>
                                                    <input type="number" step="0.00000001" name="entry_price"
                                                        class="form-control @error('entry_price') is-invalid @enderror"
                                                        value="{{ old('entry_price') }}" placeholder="0.00000000">
                                                    @error('entry_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="target_price">Target Profit *</label>
                                                    <input type="number" step="0.00000001" name="target_price"
                                                        class="form-control @error('target_price') is-invalid @enderror"
                                                        value="{{ old('target_price') }}" placeholder="0.00000000">
                                                    @error('target_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="stop_loss">Stop Loss *</label>
                                                    <input type="number" step="0.00000001" name="stop_loss"
                                                        class="form-control @error('stop_loss') is-invalid @enderror"
                                                        value="{{ old('stop_loss') }}" placeholder="0.00000000">
                                                    @error('stop_loss')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiry_days">Masa Berlaku (Hari) *</label>
                                            <select name="expiry_days"
                                                class="form-control @error('expiry_days') is-invalid @enderror">
                                                @for ($i = 1; $i <= 7; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('expiry_days') == $i ? 'selected' : '' }}>
                                                        {{ $i }} Hari
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('expiry_days')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="analysis">Analisis Teknis *</label>
                                            <textarea name="analysis" class="form-control @error('analysis') is-invalid @enderror" rows="5" id="analysis"
                                                placeholder="Analisis detail...">{{ old('analysis') }}</textarea>
                                            @error('analysis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskripsi Singkat</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Penjelasan singkat signal">{{ old('description') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Grafik (Opsional)</label>
                                            <div class="custom-file">
                                                <input type="file" name="image"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">Pilih file
                                                    gambar</label>
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Format: JPG, PNG, GIF (Maks. 2MB)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h5><i class="fas fa-info-circle mr-2"></i>Rasio Risk/Reward:
                                                <span id="risk-reward-ratio">0:1</span>
                                            </h5>
                                            <p class="mb-0">Rasio akan terhitung otomatis setelah mengisi Entry, Target
                                                dan Stop Loss</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Simpan Signal
                                </button>
                                <a href="{{ route('signal-trade.index') }}" class="btn btn-default float-right">
                                    <i class="fas fa-times mr-1"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
