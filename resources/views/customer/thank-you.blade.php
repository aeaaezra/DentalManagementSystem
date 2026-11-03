<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thank You for Your Order | Shine &amp; Smile</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff7fb;
            color: #292333;
        }
        header {
            background: #fff;
            padding: 20px 5%;
            border-bottom: 1px solid #f4dce9;
        }
        header a {
            color: #ed2788;
            text-decoration: none;
            font-size: 21px;
            font-weight: 700;
        }
        main {
            min-height: 78vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 18px;
        }
        .card {
            width: 100%;
            max-width: 620px;
            padding: 42px 30px;
            background: #fff;
            border: 1px solid #f3dce8;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 12px 35px rgba(190, 65, 125, .08);
        }
        .check {
            width: 76px;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: #ffe3f0;
            color: #ed2788;
            font-size: 40px;
            font-weight: bold;
        }
        h1 { margin: 0 0 14px; font-size: 30px; }
        p { color: #6f6673; line-height: 1.7; }
        .order-number {
            margin: 25px 0;
            padding: 17px;
            border: 1px dashed #ed8cba;
            border-radius: 10px;
            background: #fff7fb;
        }
        .order-number small {
            display: block;
            margin-bottom: 8px;
            color: #776a76;
        }
        .order-number strong {
            color: #d91e78;
            overflow-wrap: anywhere;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-top: 26px;
        }
        .btn {
            display: inline-block;
            padding: 14px 20px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 700;
        }
        .primary { background: #ed2788; color: white; }
        .secondary { border: 1px solid #ed2788; color: #d91e78; }
        @media (max-width: 480px) {
            .card { padding: 32px 20px; }
            h1 { font-size: 25px; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('customer.products') }}">♡ Shine &amp; Smile</a>
    </header>

    <main>
        <section class="card">
            <div class="check" aria-hidden="true">✓</div>
            <h1>Thank You for Your Order!</h1>
            <p>
                We appreciate your purchase at Shine &amp; Smile.
                Your order has been placed successfully.
            </p>

            <div class="order-number">
                <small>Your Order Number</small>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <p>
                You can check your order status and delivery progress
                anytime from your orders page.
            </p>

            <div class="actions">
                <a class="btn primary" href="{{ route('customer.orders') }}">
                    Track My Order
                </a>
                <a class="btn secondary" href="{{ route('customer.products') }}">
                    Continue Shopping
                </a>
            </div>
        </section>
    </main>
</body>
</html>
