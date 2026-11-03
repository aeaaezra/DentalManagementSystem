<!DOCTYPE html>
<html>
<body style="margin:0;background:#f4f6f9;padding:24px;font-family:Arial,sans-serif;color:#222;">
<div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;padding:28px;">
    <h2 style="color:#b91c1c;">Order Update</h2>
    <p>Hello {{ $order->customer?->full_name ?? 'Customer' }},</p>
    <p>We regret to inform you that your order has been declined and marked as cancelled.</p>

    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Order Status:</strong> Cancelled</p>
    <p><strong>Order Total:</strong> ₱{{ number_format((float) $order->final_amount, 2) }}</p>

    <p>If you have questions about this order, please contact Shine &amp; Smile and provide your order number.</p>
    <p>We apologize for any inconvenience.</p>
    <p style="color:#666;font-size:12px;">This is an automated notification. Please do not reply to this email.</p>
</div>
</body>
</html>
