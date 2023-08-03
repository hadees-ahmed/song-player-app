<div class="p-6 text-gray-900 dark:text-gray-100">
    {{ $song->name }}
    {{ 'Duration= ' . formatDuration($song->duration)}}
    {{'views =' . $song->views}}

    {{ $filePath = public_path('storage/' . $song->path)}}

    {{--    {{$filePath = '/Users/hadees/song-player/storage/app/public/' . $song->path}}--}}
    @if(file_exists($filePath))
    <audio controls id="audioPlayer" data-song-id="{{$song->id}}" >
        <source src="{{asset('/storage/' . $song->path )}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @endif

    <script src="{{ asset('js/audio-player.js') }}"></script>

    <a href=""> {{'Add to Favorite/ Remove from favorite'}}</a>
    {{'by ' . $song->artist->name}}
</div>
