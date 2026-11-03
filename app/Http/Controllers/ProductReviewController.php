<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Orders;
use App\Models\ProductReview;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductReviewController extends Controller
{
    public function store(Request $request, $product)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'integer'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $product = Products::where('is_active', true)
            ->findOrFail($product);

        $customer = Customer::where(
            'email',
            $request->user()->email
        )->firstOrFail();

        $order = Orders::where('id', $validated['order_id'])
            ->where('customer_id', $customer->id)
            ->where('delivery_stage', 'order_delivered')
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->first();

        if (!$order) {
            throw ValidationException::withMessages([
                'order_id' => 'You can review this product only after it has been delivered.',
            ]);
        }

        $alreadyReviewed = ProductReview::where(
            'product_id',
            $product->id
        )->where('customer_id', $customer->id)
            ->where('order_id', $order->id)
            ->exists();

        if ($alreadyReviewed) {
            throw ValidationException::withMessages([
                'rating' => 'You have already reviewed this product for this order.',
            ]);
        }

        DB::transaction(function () use (
            $product,
            $customer,
            $order,
            $validated
        ) {
            ProductReview::create([
                'product_id' => $product->id,
                'customer_id' => $customer->id,
                'order_id' => $order->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]);
        });

        return back()->with('review_success', 'Thank you! Your product review has been submitted.');
    }
}
