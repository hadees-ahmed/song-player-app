
@foreach($artists as $artist)
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <a href="{{route('songs.index', ['artist' => $artist->id])}}">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $artist->name }}
                </div>
            </div>
        </a>
    </div>
@endforeach



