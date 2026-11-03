<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class POSSettingsController extends Controller
{
    public function updatePos(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'register_number' => ['required', 'string', 'max:50'],
            'currency' => ['required', 'string', 'max:10'],
            'show_cashier_name' => ['required', 'boolean'],
            'show_customer_information' => ['required', 'boolean'],
            'show_product_sku' => ['required', 'boolean'],
            'prevent_negative_stock' => ['required', 'boolean'],
            'low_stock_warnings' => ['required', 'boolean'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue('pos', $key, $value);
        }

        return response()->json([
            'message' => 'POS settings saved successfully.',
        ]);
    }

    public function updateAppearance(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark'],
            'compact_layout' => ['required', 'boolean'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue('pos', $key, $value);
        }

        return response()->json([
            'message' => 'Appearance settings saved successfully.',
        ]);
    }
}
