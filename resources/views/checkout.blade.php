<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
</head>
<body>
    <h1>Detail Pembayaran</h1>
    <p>Invoice ID: {{ $invoice->id }}</p>
    <p>Total Pembayaran: {{ $invoice->amount }}</p>
    <a href="{{ $invoice->invoice_url }}" class="btn btn-primary">Bayar Sekarang</a>
</body>
</html>