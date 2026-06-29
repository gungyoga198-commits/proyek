<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // ============ TAMBAH KE KERANJANG ============
    public function add(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string',
            'price'     => 'required|numeric',
            'nights'    => 'required|integer|min:1',
            'checkin'   => 'required|date',
            'checkout'  => 'required|date|after:checkin',
            'guests'    => 'required|integer|min:1',
            'total'     => 'required|numeric',
        ]);

        $cart = session('booking_cart', []);

        // Cek apakah kamar sudah ada di keranjang
        $exists = collect($cart)->contains('room_name', $request->room_name);
        if (!$exists) {
            $cart[] = [
                'room_name' => $request->room_name,
                'price'     => $request->price,
                'nights'    => $request->nights,
                'checkin'   => $request->checkin,
                'checkout'  => $request->checkout,
                'guests'    => $request->guests,
                'total'     => $request->total,
            ];
            session(['booking_cart' => $cart]);
        }

        return response()->json([
            'success' => true,
            'cart'    => session('booking_cart'),
        ]);
    }

    // ============ HAPUS DARI KERANJANG ============
    public function remove(Request $request)
    {
        $request->validate(['room_name' => 'required|string']);

        $cart = session('booking_cart', []);
        $cart = array_values(
            array_filter($cart, fn($item) => $item['room_name'] !== $request->room_name)
        );
        session(['booking_cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart'    => session('booking_cart'),
        ]);
    }

    // ============ KOSONGKAN KERANJANG ============
    public function clear()
    {
        session()->forget('booking_cart');

        return response()->json([
            'success' => true,
            'cart'    => [],
        ]);
    }
}