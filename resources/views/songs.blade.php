<h2>{{$artist->name}}</h2>
<h1>{{$artist->info}}</h1>
@foreach($songs as $song)
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $song->name }}
                </div>
            </div>
    </div>
@endforeach
