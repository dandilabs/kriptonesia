@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Produk</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Jenis Produk</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="news" {{ old('type', $product->type) == 'news' ? 'selected' : '' }}>
                                    Langganan News</option>
                                <option value="membership"
                                    {{ old('type', $product->type) == 'membership' ? 'selected' : '' }}>Full Akses</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="duration">Durasi</label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                name="duration" value="{{ old('duration', $product->duration) }}" required>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price_usd">Harga (USD)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01"
                                    class="form-control @error('price_usd') is-invalid @enderror" name="price_usd"
                                    value="{{ old('price_usd', $product->price_usd) }}" required>
                                @error('price_usd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="features">Fitur (Opsional, pisahkan dengan enter)</label>
                            <textarea class="form-control @error('features') is-invalid @enderror" name="features" rows="5">{{ old('features', $product->features ? implode("\n", json_decode($product->features)) : '') }}</textarea>
                            @error('features')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </select>
                            @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
