@extends('layouts.admin')
@section('title', 'Kelola Pembayaran')

@section('content')
    <div class="container">
        <h2>Kelola Pembayaran</h2>

        @include('sweetalert::alert')

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->user->name }}<br><small>{{ $payment->user->email }}</small></td>
                            <td>{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</td>
                            <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>
                                @if ($payment->proof)
                                    <a href="{{ asset($payment->proof) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    class="badge
                            @if ($payment->status == 'paid') bg-success
                            @elseif($payment->status == 'verifying') bg-info
                            @else bg-warning @endif">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if (in_array($payment->status, ['verifying', 'pending']))
                                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Verifikasi
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada pembayaran yang perlu diverifikasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
