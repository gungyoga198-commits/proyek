<!-- ROOMS PAGE -->
<main>

    <x-page-banner
        image="/images/OGAG.jpg"
        eyebrow="EXPLORE"
        title="OUR ROOMS"
        subtitle="Temukan kenyamanan dan kemewahan di setiap kamar kami"
        overlay="bg-black/50"
        :show-line="false"
    />

    <x-breadcrumb :links="[
        ['label' => 'Rooms'],
    ]" />

    <!-- ROOMS SECTION -->
    <section class="bg-gray-100 py-20 px-10">

        <!-- TITLE -->
        <div class="text-center mb-14">
            <p class="text-sm tracking-widest text-gray-500">CHOOSE YOUR</p>
            <h2 class="text-3xl font-semibold mb-3">PERFECT ROOM</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-sm">
                Discover exclusive savings and distinct offerings at iconic destinations spanning coast to coast.
            </p>
        </div>

        <!-- CARD CONTAINER -->
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <!-- CARD 1 - CLASSIC -->
            <a href="{{ route('room.detail', 'classic') }}"
               class="block bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">

                <div class="relative overflow-hidden">
                    <img src="/images/Deluxe.jpg"
                         class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500"
                         alt="Classic Room">

                    <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 rounded-sm tracking-widest">
                        CLASSIC
                    </div>
                </div>

                <div class="p-5 text-sm">

                    <p class="font-semibold text-lg">
                        Classic Terrace
                    </p>

                    <p class="text-gray-400 mb-3 text-xs tracking-wide">
                        Ground Floor · Garden View
                    </p>

                    <p class="text-gray-600 mb-5 leading-relaxed">
                        Located on the ground floor and designed to accommodate up to 2 persons, with the option of a queen and twin beds.
                    </p>

                    <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-5">
                        <span>👤 2 People</span>
                        <span>🌿 Pool or Garden</span>
                        <span>📐 25 m²</span>
                        <span>🛏 Double Extra</span>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">

                        <div>
                            <p class="text-xs text-gray-400">
                                Start from
                            </p>

                            <p class="text-yellow-600 font-semibold text-base">
                                Rp 850.000
                                <span class="text-xs text-gray-400 font-normal">
                                    / night
                                </span>
                            </p>
                        </div>

                        <div class="bg-yellow-600 text-white px-4 py-2 text-xs rounded-sm">
                            VIEW DETAIL
                        </div>

                    </div>

                </div>

            </a>

            <!-- CARD 2 - DELUXE -->
            <a href="{{ route('room.detail', 'deluxe') }}"
               class="block bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">

                <div class="relative overflow-hidden">
                    <img src="/images/Family.jpg"
                         class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500"
                         alt="Deluxe Room">

                    <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 rounded-sm tracking-widest">
                        DELUXE
                    </div>
                </div>

                <div class="p-5 text-sm">

                    <p class="font-semibold text-lg">
                        Deluxe Daybed
                    </p>

                    <p class="text-gray-400 mb-3 text-xs tracking-wide">
                        Upper & Ground Floor · Balcony
                    </p>

                    <p class="text-gray-600 mb-5 leading-relaxed">
                        Located on the upper & ground floor designed to accommodate up to 3 persons, with balcony overlooking garden.
                    </p>

                    <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-5">
                        <span>👤 3 People</span>
                        <span>🌿 Pool or Garden</span>
                        <span>📐 39 m²</span>
                        <span>🛏 Double Extra</span>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">

                        <div>
                            <p class="text-xs text-gray-400">
                                Start from
                            </p>

                            <p class="text-yellow-600 font-semibold text-base">
                                Rp 1.200.000
                                <span class="text-xs text-gray-400 font-normal">
                                    / night
                                </span>
                            </p>
                        </div>

                        <div class="bg-yellow-600 text-white px-4 py-2 text-xs rounded-sm">
                            VIEW DETAIL
                        </div>

                    </div>

                </div>

            </a>

            <!-- CARD 3 - SUPERIOR -->
            <a href="{{ route('room.detail', 'superior') }}"
               class="block bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">

                <div class="relative overflow-hidden">
                    <img src="/images/Presidential.jpg"
                         class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500"
                         alt="Superior Room">

                    <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 rounded-sm tracking-widest">
                        SUPERIOR
                    </div>
                </div>

                <div class="p-5 text-sm">

                    <p class="font-semibold text-lg">
                        Superior Room
                    </p>

                    <p class="text-gray-400 mb-3 text-xs tracking-wide">
                        1st & 2nd Floor · Garden View
                    </p>

                    <p class="text-gray-600 mb-5 leading-relaxed">
                        Located on the 1st & 2nd floor designed to accommodate up to 3 persons, with balcony overlooking garden.
                    </p>

                    <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-5">
                        <span>👤 2 People</span>
                        <span>🌿 Garden</span>
                        <span>📐 30 m²</span>
                        <span>🛏 Double / Twin Bed</span>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">

                        <div>
                            <p class="text-xs text-gray-400">
                                Start from
                            </p>

                            <p class="text-yellow-600 font-semibold text-base">
                                Rp 1.500.000
                                <span class="text-xs text-gray-400 font-normal">
                                    / night
                                </span>
                            </p>
                        </div>

                        <div class="bg-yellow-600 text-white px-4 py-2 text-xs rounded-sm">
                            VIEW DETAIL
                        </div>

                    </div>

                </div>

            </a>

        </div>

    </section>

</main>