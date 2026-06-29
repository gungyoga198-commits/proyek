<div class="bg-white px-16 py-4 border-b text-sm text-gray-500 flex items-center gap-1">

    <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>

    @foreach($links as $link)

        <span class="mx-1 text-gray-300">/</span>

        @if(isset($link['route']))
            <a href="{{ route($link['route']) }}" class="hover:text-yellow-600 transition">
                {{ $link['label'] }}
            </a>
        @else
            <span class="text-yellow-600 font-medium">{{ $link['label'] }}</span>
        @endif

    @endforeach

</div>