<div class="p-6 text-gray-900 dark:text-gray-100">
    {{ $song->name }}
    {{ 'Duration = ' . formatDuration($song->duration)}}
    {{'views ='}}
    <audio controls>
        <source src="{{asset('/storage/' . $song->path )}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <a href=""> {{'Add to Favorite/ Remove from favorite'}}</a>
    {{'by ' . $song->artist->name}}
</div>
