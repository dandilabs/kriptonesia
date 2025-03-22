@extends('layouts.admin')
@section('title', 'Kelola Pembayaran')

@section('content')
<div class="container">
    <h2>Kelola Pembayaran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->user->name }}</td>
                <td>{{ ucfirst($payment->payment_type) }}</td>
                <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                <td>
                    @if ($payment->proof)
                        <a href="{{ asset($payment->proof) }}" target="_blank">Lihat Bukti</a>
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>
                    <span class="badge {{ $payment->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </td>
                <td>
                    @if ($payment->status == 'pending')
                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Tandai sebagai Paid</button>
                    </form>
                    @else
                        ✅ Sudah Dibayar
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
