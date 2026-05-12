<!--NAVBAR -->
<header class="absolute top-0 w-full z-20">
    <nav class="flex justify-between items-center px-16 h-20">

        <a href="{{ route('home') }}" class="flex items-center">
            <img src="/images/LogoHotel.png" alt="logo" class="h-24 w-auto object-contain">
        </a>

        <ul class="flex gap-8 items-center {{ request()->is('contact') || request()->is('rooms') || request()->is('gallery') || request()->is('cek-reservasi') || request()->is('booking') || request()->is('reservation') || request()->is('booking/success/*') || request()->is('room/*') ? 'text-white' : 'text-black' }}">

            <li>
                <a href="{{ route('home') }}"
                   class="hover:text-yellow-600 transition {{ request()->routeIs('home') ? 'text-yellow-600 font-semibold' : '' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('rooms') }}"
                   class="hover:text-yellow-600 transition {{ request()->routeIs('rooms') ? 'text-yellow-600 font-semibold' : '' }}">
                    Rooms
                </a>
            </li>

            <li>
                <a href="{{ route('gallery') }}"
                   class="hover:text-yellow-600 transition {{ request()->routeIs('gallery') ? 'text-yellow-600 font-semibold' : '' }}">
                    Gallery
                </a>
            </li>

            <li>
                <a href="{{ route('contact') }}"
                   class="hover:text-yellow-600 transition {{ request()->routeIs('contact') ? 'text-yellow-600 font-semibold' : '' }}">
                    Contact
                </a>
            </li>

            <li>
                <a href="{{ route('reservasi.cek.form') }}"
                   class="hover:text-yellow-600 transition {{ request()->routeIs('reservasi.cek*') ? 'text-yellow-600 font-semibold' : '' }}">
                    Cek Reservasi
                </a>
            </li>

            <li>
                <a href="{{ route('booking') }}"
                    class="bg-yellow-600 text-white px-5 py-2 hover:bg-yellow-700 transition">
                    BOOK NOW
                </a>
            </li>
        </ul>
    </nav>
</header>