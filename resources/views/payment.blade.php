@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Pembayaran Membership</h2>
    <p>Silakan lakukan pembayaran untuk mengaktifkan akun Anda.</p>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    alert('Pembayaran sukses!');
                    window.location.href = "{{ route('payment.success', ['user' => $user->id]) }}";
                },
                onPending: function(result) {
                    alert('Menunggu pembayaran...');
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                }
            });
        };
    </script>
</div>
@endsection
