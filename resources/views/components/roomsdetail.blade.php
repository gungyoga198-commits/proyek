<main class="bg-gray-100 min-h-screen">

    <x-page-banner
        image="/images/OGAG.jpg"
        eyebrow="Detail Kamar"
        title="DETAIL LAMAR"
        subtitle="Masukkan kode booking atau email untuk melihat status reservasi Anda"
    />

    <x-breadcrumb :links="[
        ['label' => 'Rooms', 'route' => 'rooms'],
        ['label' => 'Detail'],
    ]" />

    {{-- CONTENT --}}
    <section class="max-w-6xl mx-auto py-16 px-10">

        <div class="grid md:grid-cols-3 gap-10">

            {{-- LEFT --}}
            <div class="md:col-span-2">

                <h2 class="text-2xl font-semibold mb-5">
                    Room Description
                </h2>

                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $room['description'] }}
                </p>

                <div class="grid grid-cols-2 gap-5 mb-10">

                    <div class="bg-white p-5 rounded shadow-sm">
                        👤 <strong>{{ $room['capacity'] }}</strong>
                    </div>

                    <div class="bg-white p-5 rounded shadow-sm">
                        🌿 <strong>{{ $room['view'] }}</strong>
                    </div>

                    <div class="bg-white p-5 rounded shadow-sm">
                        📐 <strong>{{ $room['size'] }}</strong>
                    </div>

                    <div class="bg-white p-5 rounded shadow-sm">
                        🛏 <strong>{{ $room['bed'] }}</strong>
                    </div>

                </div>

                <h3 class="text-xl font-semibold mb-4">
                    Facilities
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach($room['facilities'] as $facility)

                        <span class="bg-white border px-4 py-2 rounded-full text-sm">
                            {{ $facility }}
                        </span>

                    @endforeach

                </div>

            </div>

            {{-- RIGHT --}}
            <div>

                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-10">

                    <p class="text-gray-400 text-sm mb-1">
                        Start From
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mb-6">
                        Rp {{ $room['price'] }}
                    </h2>

                    <a href="{{ route('booking') }}"
                       class="block w-full bg-yellow-600 text-white text-center py-3 rounded hover:bg-yellow-700 transition">

                        BOOK NOW

                    </a>

                </div>

            </div>

        </div>

    </section>

</main>