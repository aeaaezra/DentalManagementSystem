@php
    $order->loadMissing(['customer', 'items.product', 'items.variant']);
@endphp

<style>
    #order-print-modal {
        color: #111827;
        background: #ffffff;
        padding: 22px;
        border-radius: 10px;
        font-size: 13px;
    }

    #order-print-modal h2 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    #order-print-modal h3 {
        font-size: 15px;
        font-weight: 700;
        margin: 20px 0 8px;
    }

    #order-print-modal .order-muted {
        color: #6b7280;
    }

    #order-print-modal .order-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-top: 18px;
    }

    #order-print-modal .order-box {
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        padding: 12px;
        overflow-wrap: anywhere;
    }

    #order-print-modal .order-label {
        color: #6b7280;
        font-size: 11px;
        margin-bottom: 4px;
    }

    #order-print-modal .order-value {
        font-weight: 600;
    }

    #order-print-modal table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    #order-print-modal th,
    #order-print-modal td {
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        padding: 9px 5px;
    }

    #order-print-modal th {
        background: #f3f4f6;
        font-weight: 700;
    }

    #order-print-modal .order-totals {
        margin: 16px 0 0 auto;
        max-width: 280px;
    }

    #order-print-modal .order-total-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 5px 0;
    }

    #order-print-modal .order-grand-total {
        border-top: 2px solid #111827;
        margin-top: 6px;
        padding-top: 10px;
        font-size: 16px;
        font-weight: 800;
    }

    #order-print-modal .order-print-button {
        background: #db2777;
        color: #ffffff;
        padding: 10px 22px;
        border: 0;
        border-radius: 7px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 22px;
    }

    @media print {
        body * {
            visibility: hidden !important;
        }

        #order-print-modal,
        #order-print-modal * {
            visibility: visible !important;
        }

        #order-print-modal {
            display: block !important;
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
            padding: 0 !important;
            margin: 0 !important;
            border: 0 !important;
            border-radius: 0 !important;
            color: #111827 !important;
            background: #ffffff !important;
        }

        #order-print-modal .order-print-button {
            display: none !important;
        }

        #order-print-modal th {
            background: #f3f4f6 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        @page {
            size: A4 portrait;
            margin: 15mm;
        }
    }
</style>

<div id="order-print-modal">
    <div style="text-align:center; padding-bottom:15px; border-bottom:2px solid #111827;">
        <h2>Shine &amp; Smile</h2>
        <div class="order-muted">Dental Management System</div>
        <h3 style="margin-top:14px;">ORDER DETAILS</h3>
        <div><strong>{{ $order->order_number }}</strong></div>
        <div class="order-muted">
            {{ $order->order_date?->format('F d, Y h:i A') ?? $order->created_at?->format('F d, Y h:i A') }}
        </div>
    </div>

    <div class="order-grid">
        <div class="order-box">
            <h3 style="margin-top:0;">Customer Information</h3>
            <div class="order-label">Customer Name</div>
            <div class="order-value">{{ $order->customer?->full_name ?? '—' }}</div>

            <div class="order-label" style="margin-top:10px;">Contact Number</div>
            <div class="order-value">{{ $order->contact_number ?? '—' }}</div>

            <div class="order-label" style="margin-top:10px;">Email</div>
            <div class="order-value">{{ $order->customer?->email ?? '—' }}</div>
        </div>

        <div class="order-box">
            <h3 style="margin-top:0;">Delivery Information</h3>
            <div class="order-label">Delivery Address</div>
            <div class="order-value">{{ $order->delivery_address ?? '—' }}</div>

            <div class="order-label" style="margin-top:10px;">Order Status</div>
            <div class="order-value">{{ ucfirst($order->order_status ?? '—') }}</div>

            <div class="order-label" style="margin-top:10px;">Payment</div>
            <div class="order-value">
                {{ strtoupper($order->payment_method ?? '—') }}
                — {{ ucfirst($order->payment_status ?? '—') }}
            </div>
        </div>
    </div>

    <h3>Purchased Items</h3>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Variant</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order->items as $item)
                <tr>
                    <td>{{ $item->product?->product_name ?? 'Product unavailable' }}</td>
                    <td>{{ $item->variant?->name ?? 'Standard' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₱{{ number_format((float) $item->unit_price, 2) }}</td>
                    <td>₱{{ number_format((float) $item->subtotal, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No order items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="order-totals">
        <div class="order-total-row">
            <span>Subtotal / Total Amount</span>
            <span>₱{{ number_format((float) $order->total_amount, 2) }}</span>
        </div>
        <div class="order-total-row">
            <span>Shipping Fee</span>
            <span>₱{{ number_format((float) $order->shipping_fee, 2) }}</span>
        </div>
        <div class="order-total-row">
            <span>Discount</span>
            <span>₱{{ number_format((float) $order->discount_amount, 2) }}</span>
        </div>
        <div class="order-total-row order-grand-total">
            <span>Final Amount</span>
            <span>₱{{ number_format((float) $order->final_amount, 2) }}</span>
        </div>
    </div>

    @if ($order->notes)
        <h3>Notes</h3>
        <div>{{ $order->notes }}</div>
    @endif

    <div style="text-align:right;">
        <button
            type="button"
            class="order-print-button"
            onclick="window.print()">
            Print Order
        </button>
    </div>
</div>
