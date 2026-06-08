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

        $message = "Salam, bu məhsulları sifariş etmək istəyirəm:\n\n";

        $i = 1;
        foreach ($cart as $id => $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $totalPrice += $itemTotal;

            // Şəkil linkini tam URL halına salırıq
            $imageUrl = $item['image'] ? asset('storage/' . $item['image']) : asset('web/image/no-image.png');

            // Hər məhsulun məlumat sətiri
            $message .= "📦 *Məhsul {$i}:* {$item['name']}\n";
            $message .= "🔢 *Say:* {$item['quantity']} ədəd\n";
            $message .= "💰 *Qiymət:* \${$item['price']}\n";
            $message .= "🖼️ *Şəkil:* {$imageUrl}\n";
            $message .= "---------------------------\n\n";
            $i++;
        }

        $message .= "💵 *Yekun Məbləğ:* \${$totalPrice}";
        $encodedMessage = urlencode($message);

        // Tam WhatsApp yönləndirmə linki
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
        $quantity = $request->input('quantity', 1);

        $product = Product::with('translations')->find($productId);

        if (!$product) {
            return response()->json(['error' => 'Məhsul tapılmadı!'], 404);
        }

        $translation = $product->translations->where('locale', app()->getLocale())->first()
            ?? $product->translations->where('locale', 'az')->first();

        $productName = $translation->name ?? $product->name;

        $currentPrice = ($product->price_type == 'retail')
            ? $product->retail_price
            : $product->wholesale_price;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $productName,
                "quantity" => $quantity,
                "price" => $currentPrice,
                "image" => $product->images->first()->image ?? null
            ];
        }

        session()->put('cart', $cart);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => 'Məhsul səbətə əlavə edildi!',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => number_format($total, 2)
        ]);
    }
}
