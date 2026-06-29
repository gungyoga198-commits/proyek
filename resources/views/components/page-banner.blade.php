<section class="relative h-72 flex items-center justify-center overflow-hidden">
    <img src="{{ $image }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $title }}">
    <div class="absolute inset-0 {{ $overlay }} pointer-events-none"></div>

    <div class="relative text-center text-white z-10 px-4">

        @if($eyebrow)
            <p class="tracking-widest text-sm text-yellow-400 mb-2 uppercase">{{ $eyebrow }}</p>
        @endif

        <h1 class="text-4xl font-semibold tracking-widest">{{ $title }}</h1>

        @if($showLine)
            <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
        @endif

        @if($subtitle)
            <p class="mt-4 text-gray-300 text-sm">{{ $subtitle }}</p>
        @endif

    </div>
</section>