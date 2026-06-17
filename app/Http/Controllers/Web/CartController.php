<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        $whatsAppNumber = "994505914145";

        $date = date('d.m.y');

        $companyName = "Müştəri";
        if (auth()->guard('company')->check()) {
            $companyName = auth()->guard('company')->user()->company_name;
        }

        $message = "{$date}\n";
        $message .= "Sifariş : {$companyName}\n\n";

        foreach ($cart as $id => $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $totalPrice += $itemTotal;

            $productCode = $item['code'] ?? null;
            if (!$productCode) {
                $product = \App\Models\Product::find($id);
                $productCode = $product ? $product->code : '';
            }

            $codeText = $productCode ? " ( kod: {$productCode} )" : "";

            $message .= "{$item['name']}{$codeText} {$item['quantity']} ədəd x " . number_format($item['price'], 2) . " ₼\n";
        }

        $message .= "\nCəm " . number_format($totalPrice, 2) . " ₼";

        $encodedMessage = urlencode($message);

        $whatsAppLink = "https://api.whatsapp.com/send?phone={$whatsAppNumber}&text={$encodedMessage}";

        return view('site.cart.index', compact('cart', 'totalPrice', 'whatsAppLink'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Məhsulu səbətdən silirik
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Məhsul səbətdən silindi!');
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $product = Product::with(['translations', 'images'])->find($productId);

        if (!$product) {
            return response()->json(['error' => 'Məhsul tapılmadı!'], 404);
        }

        $translation = $product->translations->where('locale', app()->getLocale())->first()
            ?? $product->translations->where('locale', 'az')->first();

        $productName = $translation->name ?? $product->name;

        // ===============================
        // 🔥 PRICE PRIORITY LOGIC
        // ===============================
        $price = null;

        // 1. ENDİRİM VARSA → ONU GÖTÜR
        if (!empty($product->discount_price) && $product->discount_price > 0) {
            $price = $product->discount_price;
        }
        // 2. WHolesale user
        elseif (
            auth()->guard('company')->check() &&
            auth()->guard('company')->user()->price_type === 'wholesale'
        ) {
            $price = $product->wholesale_price;
        }
        // 3. default retail
        else {
            $price = $product->retail_price;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $productName,
                "quantity" => $quantity,
                "price" => $price,
                "image" => $product->images->first()->image ?? null
            ];
        }

        session()->put('cart', $cart);

        $total = 0;
        $formattedItems = [];

        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];

            $formattedItems[] = [
                'id'        => $id,
                'name'      => $item['name'],
                'price'     => number_format($item['price'], 2),
                'quantity'  => $item['quantity'],
                'image_url' => $item['image']
                    ? asset('storage/' . $item['image'])
                    : asset('assets/no-image.png')
            ];
        }

        return response()->json([
            'success'    => 'Məhsul səbətə əlavə edildi!',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => number_format($total, 2),
            'cart_items' => $formattedItems
        ]);
    }
}
