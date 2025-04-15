@extends('layouts.admin')

@section('content')
    @include('sweetalert::alert')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Signal Trading</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('signal-trade.index') }}">Daftar Signal</a></li>
                        <li class="breadcrumb-item active">Edit Signal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit mr-2"></i>Form Edit Signal
                            </h3>
                        </div>
                        <form method="post" action="{{ route('signal-trade.update', $signal_trade->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Signal *</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $signal_trade->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Contoh: Signal BTC Breakout">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="symbol">Pair Trading *</label>
                                            <input type="text" name="symbol"
                                                value="{{ old('symbol', $signal_trade->symbol) }}"
                                                class="form-control @error('symbol') is-invalid @enderror"
                                                placeholder="Contoh: BTC/USDT">
                                            @error('symbol')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Jenis Signal *</label>
                                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                                <option value="">-- Pilih Jenis --</option>
                                                <option value="buy"
                                                    {{ old('type', $signal_trade->type) == 'buy' ? 'selected' : '' }}>Buy
                                                    (Beli)</option>
                                                <option value="sell"
                                                    {{ old('type', $signal_trade->type) == 'sell' ? 'selected' : '' }}>Sell
                                                    (Jual)</option>
                                                <option value="strong_buy"
                                                    {{ old('type', $signal_trade->type) == 'strong_buy' ? 'selected' : '' }}>
                                                    Strong Buy (Beli Kuat)</option>
                                                <option value="strong_sell"
                                                    {{ old('type', $signal_trade->type) == 'strong_sell' ? 'selected' : '' }}>
                                                    Strong Sell (Jual Kuat)</option>
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
                                                        value="{{ old('entry_price', $signal_trade->entry_price) }}"
                                                        class="form-control @error('entry_price') is-invalid @enderror"
                                                        placeholder="0.00000000">
                                                    @error('entry_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="target_price">Target Profit *</label>
                                                    <input type="number" step="0.00000001" name="target_price"
                                                        value="{{ old('target_price', $signal_trade->target_price) }}"
                                                        class="form-control @error('target_price') is-invalid @enderror"
                                                        placeholder="0.00000000">
                                                    @error('target_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="stop_loss">Stop Loss *</label>
                                                    <input type="number" step="0.00000001" name="stop_loss"
                                                        value="{{ old('stop_loss', $signal_trade->stop_loss) }}"
                                                        class="form-control @error('stop_loss') is-invalid @enderror"
                                                        placeholder="0.00000000">
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
                                            <label for="expiry_days">Perpanjang Masa Berlaku (Hari)</label>
                                            <select name="expiry_days"
                                                class="form-control @error('expiry_days') is-invalid @enderror">
                                                <option value="0" selected>-- Tidak Diperpanjang --</option>
                                                @for ($i = 1; $i <= 7; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('expiry_days') == $i ? 'selected' : '' }}>
                                                        Tambah {{ $i }} Hari
                                                    </option>
                                                @endfor
                                            </select>
                                            <small class="text-muted">Saat ini berakhir:
                                                {{ $signal_trade->expired_at->format('d M Y H:i') }}</small>
                                            @error('expiry_days')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="analysis">Analisis Teknis *</label>
                                            <textarea name="analysis" class="form-control @error('analysis') is-invalid @enderror" rows="5"
                                                id="analysis">{{ old('analysis', $signal_trade->analysis) }}</textarea>
                                            @error('analysis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskripsi Singkat</label>
                                            <textarea name="description" class="form-control" rows="3">{{ old('description', $signal_trade->description) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Grafik (Opsional)</label>
                                            <div class="custom-file">
                                                <input type="file" name="image"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">
                                                    @if ($signal_trade->image)
                                                        Ganti file gambar (sekarang: {{ basename($signal_trade->image) }})
                                                    @else
                                                        Pilih file gambar
                                                    @endif
                                                </label>
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Format: JPG, PNG, GIF (Maks. 2MB)</small>

                                            @if ($signal_trade->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($signal_trade->image) }}" class="img-thumbnail"
                                                        width="200">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_image" id="remove_image"
                                                            class="form-check-input">
                                                        <label for="remove_image"
                                                            class="form-check-label text-danger">Hapus gambar saat
                                                            disimpan</label>
                                                    </div>
                                                </div>
                                            @endif
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
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
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

@push('css')
    <style>
        .custom-file-label::after {
            content: "Browse";
        }

        .invalid-feedback {
            display: block;
        }
    </style>
@endpush

@push('js')
    <script>
        // Inisialisasi file input
        $(document).ready(function() {
            bsCustomFileInput.init();

            // Toggle leverage field
            $('#tradeTypeSelect').change(function() {
                if ($(this).val() === 'future') {
                    $('#leverageField').show();
                } else {
                    $('#leverageField').hide();
                    $('input[name="leverage"]').val('');
                }
            });

            // Inisialisasi text editor untuk analisis
            $('#analysis').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture']]
                ]
            });

            // Hitung rasio risk/reward otomatis
            function calculateRiskReward() {
                const entry = parseFloat($('input[name="entry_price"]').val()) || 0;
                const target = parseFloat($('input[name="target_price"]').val()) || 0;
                const stopLoss = parseFloat($('input[name="stop_loss"]').val()) || 0;

                if (entry > 0 && target > 0 && stopLoss > 0) {
                    const reward = target - entry;
                    const risk = entry - stopLoss;
                    const ratio = risk > 0 ? (reward / risk).toFixed(2) : 0;
                    $('#risk-reward-ratio').text(ratio + ':1');
                } else {
                    $('#risk-reward-ratio').text('0:1');
                }
            }

            // Hitung saat load pertama kali
            calculateRiskReward();

            // Hitung saat input berubah
            $('input[name="entry_price"], input[name="target_price"], input[name="stop_loss"]').on('input',
                calculateRiskReward);
        });
    </script>
@endpush
