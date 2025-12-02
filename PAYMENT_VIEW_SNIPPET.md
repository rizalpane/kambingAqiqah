{{-- 
PAYMENT VIEW UPDATE - Copy the content below dan replace di resources/views/user/payment.blade.php

Ganti bagian "Metode Pembayaran" dengan code berikut:
--}}

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Metode Pembayaran</h5>
        <hr>
        <p class="text-muted">Klik tombol di bawah untuk melanjutkan pembayaran via Midtrans</p>
        
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success btn-lg" onclick="payWithMidtrans()">
                <i class="bi bi-credit-card"></i> Bayar Sekarang via Midtrans
            </button>
            
            <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke History
            </a>
        </div>
    </div>
</div>

{{-- Load Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
    var snapToken = '{{ isset($snapToken) ? $snapToken : "" }}';

    function payWithMidtrans() {
        if (!snapToken) {
            alert('Token pembayaran tidak ditemukan. Silahkan refresh halaman.');
            return;
        }

        snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('Payment Success:', result);
                // Redirect ke halaman sukses
                window.location.href = '{{ route("user.payment.success", $order->id) }}';
            },
            onPending: function(result) {
                console.log('Payment Pending:', result);
                alert('Pembayaran masih diproses');
            },
            onError: function(result) {
                console.log('Payment Error:', result);
                // Redirect ke halaman gagal
                window.location.href = '{{ route("user.payment.failed", $order->id) }}';
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran. Pembayaran belum selesai.');
            }
        });
    }

    // Auto-trigger payment dialog saat halaman selesai loading (opsional)
    // Uncomment line di bawah jika ingin auto-open payment modal
    // window.addEventListener('load', function() {
    //     payWithMidtrans();
    // });
</script>
