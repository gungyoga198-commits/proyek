@extends('layouts.app')

@section('title', 'Booking')

@section('content')
<div class="bg-gray-100 min-h-screen pt-24 pb-10 px-6">

    <!-- Top Booking Bar -->
    <div class="bg-white shadow-md rounded-xl p-4 flex flex-wrap items-center justify-between gap-4">
        <div class="flex gap-6 items-center">
            <div>
                <p class="text-xs text-gray-500">CHECK-IN</p>
                <input type="date" id="checkin" class="border p-1 rounded">
            </div>
            <div>
                <p class="text-xs text-gray-500">CHECK-OUT</p>
                <input type="date" id="checkout" class="border p-1 rounded">
            </div>
            <div>
                <p class="text-xs text-gray-500">GUEST</p>
                <input type="number" id="guest" value="2" class="border p-1 w-16 rounded">
            </div>
        </div>

        <button onclick="goToReservation()" class="bg-yellow-600 text-white px-6 py-2 rounded-full">
            BOOK
        </button>
    </div>

    <!-- Room Card -->
    <div class="mt-6 bg-white rounded-xl shadow p-6 flex gap-6">
        <img src="/images/Family.jpg" class="w-64 h-40 object-cover rounded-lg">

        <div class="flex-1">
            <h3 class="text-lg font-bold">ONE BEDROOM STUDIO</h3>
            <p class="text-sm text-gray-600 mt-2">Room nyaman untuk keluarga.</p>

            <p class="mt-4 text-sm">Harga: <strong id="price">2062500</strong></p>
        </div>

        <button onclick="addToCart()" class="bg-yellow-600 text-white px-4 py-2 rounded-full">
            ADD
        </button>
    </div>

    <!-- Cart -->
    <div class="mt-6 bg-white p-4 rounded-xl shadow">
        <h3 class="font-bold">Keranjang</h3>
        <div id="cart"></div>
    </div>

</div>

<script>
let cart = [];

function addToCart() {
    const room = {
        name: "ONE BEDROOM STUDIO",
        price: 2062500
    };

    cart.push(room);
    renderCart();
}

function renderCart() {
    let html = "";
    cart.forEach((item, index) => {
        html += `<p>${item.name} - Rp ${item.price.toLocaleString()}</p>`;
    });

    document.getElementById("cart").innerHTML = html || "Belum ada room";
}

function goToReservation() {
    localStorage.setItem("cart", JSON.stringify(cart));
    window.location.href = "/reservation";
}
</script>
@endsection
