<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Finish</title>
</head>
<body>
    @if($transaction)
    <h1> Payment Detail</h1>
    <h2>Status Order: {{ $transaction->status }}</h2>
    <h2>Order Id: {{ $transaction->transaction_code }}</h2>
    @else
        <h1> Invalid Order</h1>
    @endif
</body>
</html>
