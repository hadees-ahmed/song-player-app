<div class="p-6 text-gray-900 dark:text-gray-100">
    {{ $song->name }}
    {{ 'Duration = ' . formatDuration($song->duration)}}
    {{'views ='}}
    <audio controls>
        <source src="{{asset('/storage/' . $song->path )}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @if(auth()->user()->favorites->contains($song->id))
        <a href="{{ route('remove.favorites', ['song' => $song->id]) }}">Remove from Favorite {{$song->id}}</a>
    @else
        <a href="{{ route('add.favorites', ['song' => $song->id]) }}">Add to Favorite {{$song->id}}</a>
    @endif
    {{'by ' . $song->artist->name}}
</div>
