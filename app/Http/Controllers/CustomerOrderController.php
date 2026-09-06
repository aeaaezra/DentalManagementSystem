<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerOrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PRODUCTS / SHOP
    |--------------------------------------------------------------------------
    */

    public function products()
    {
        $products = Products::query()
            ->where('is_active', true)
            ->where('quantity', '>', 0)
            ->orderBy('product_name', 'asc')
            ->get();

        return view(
            'customer.products',
            compact('products')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        return view('customer.cart');
    }


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        return view('customer.checkout');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ORDER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'payment_method' => [
                'required',
                'string',
                'max:50',
            ],
        ]);


        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | FIND CUSTOMER
        |--------------------------------------------------------------------------
        */

        $customer = Customer::where(
            'user_id',
            $user->id
        )->first();


        if (!$customer) {

            return response()->json([
                'success' => false,

                'message' =>
                    'Customer profile was not found.',
            ], 422);

        }


        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use (
            $request,
            $customer,
            $user
        ) {

            $total = 0;

            $items = [];


            /*
            |--------------------------------------------------------------------------
            | CHECK PRODUCTS
            |--------------------------------------------------------------------------
            */

            foreach ($request->items as $cartItem) {

                $product = Products::lockForUpdate()
                    ->findOrFail(
                        $cartItem['product_id']
                    );


                $quantity = (int) $cartItem['quantity'];


                /*
                |--------------------------------------------------------------------------
                | CHECK PRODUCT STATUS
                |--------------------------------------------------------------------------
                */

                if (!$product->is_active) {

                    abort(
                        422,
                        "{$product->product_name} is currently unavailable."
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | CHECK STOCK
                |--------------------------------------------------------------------------
                */

                if ($product->quantity < $quantity) {

                    abort(
                        422,
                        "Insufficient stock for {$product->product_name}."
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | PRICE
                |--------------------------------------------------------------------------
                */

                $price = (float) $product->selling_price;


                $subtotal =
                    $price * $quantity;


                $total += $subtotal;


                $items[] = [

                    'product' =>
                        $product,

                    'quantity' =>
                        $quantity,

                    'price' =>
                        $price,

                    'subtotal' =>
                        $subtotal,

                ];
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE ORDER
            |--------------------------------------------------------------------------
            */

            $order = Orders::create([

                'customer_id' =>
                    $customer->id,

                'order_no' =>
                    'ORD-' .
                    now()->format('YmdHis') .
                    '-' .
                    strtoupper(
                        Str::random(5)
                    ),

                'customer_name' =>
                    $user->name,

                'contact_number' =>
                    $customer->contact_number ?? null,

                'address' =>
                    $customer->address ?? null,

                'total_amount' =>
                    $total,

                'payment_method' =>
                    $request->payment_method,

                'payment_status' =>
                    'pending',

                'status' =>
                    'pending',

            ]);


            /*
            |--------------------------------------------------------------------------
            | CREATE ORDER ITEMS
            |--------------------------------------------------------------------------
            */

            foreach ($items as $item) {

                OrderItems::create([

                    'order_id' =>
                        $order->id,

                    'product_id' =>
                        $item['product']->id,

                    'quantity' =>
                        $item['quantity'],

                    'price' =>
                        $item['price'],

                    'subtotal' =>
                        $item['subtotal'],

                ]);


                /*
                |--------------------------------------------------------------------------
                | REDUCE PRODUCT STOCK
                |--------------------------------------------------------------------------
                */

                $item['product']->decrement(
                    'quantity',
                    $item['quantity']
                );
            }


            return $order;
        });


        /*
        |--------------------------------------------------------------------------
        | RETURN RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'message' =>
                'Your order has been submitted successfully.',

            'order_id' =>
                $order->id,

            'order_no' =>
                $order->order_no,

            'redirect' =>
                route('customer.orders'),

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER ORDERS
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        $user = auth()->user();


        $customer = Customer::where(
            'user_id',
            $user->id
        )->first();


        if (!$customer) {

            $orders = collect();

        } else {

            $orders = Orders::with([
                'items.product'
            ])
                ->where(
                    'customer_id',
                    $customer->id
                )
                ->latest()
                ->get();
        }


        return view(
            'customer.orders',
            compact('orders')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER SETTINGS
    |--------------------------------------------------------------------------
    */

    public function settings()
    {
        return view('customer.settings');
    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER PROFILE
    |--------------------------------------------------------------------------
    */

    public function profile()
    {
        $user = auth()->user();

        $customer = Customer::where(
            'user_id',
            $user->id
        )->first();

        return view(
            'customer.profile',
            compact('customer')
        );
    }
}
