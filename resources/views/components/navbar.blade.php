<!--NAVBAR -->
    <header class="absolute top-0 w-full z-20">
        <nav class="flex justify-between items-center px-16 py-5">
            <img src="/images/LogoHotel.png" alt="logo" class="h-10">

            <ul class="flex gap-8 items-center 
                {{ request()->is('contact') ? 'text-white' : 'text-black' }}">

                <li>
                <a href="{{ route('home') }}">Home</a>
                </li>

                <li>Rooms</li>
                <li>Gallery</li>
                <li>
                    <a href="{{ route('contact') }}">Contact</a>
                </li>

                <li>
                    <button class="bg-yellow-600 text-white px-5 py-2">
                        BOOK NOW
                    </button>
                </li>
            </ul>
        </nav>
    </header>