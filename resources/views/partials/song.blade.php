@foreach($songs as $song)
<div class="p-6 text-gray-900">
    {{ $song->name }}
    {{ 'Duration= ' . formatDuration($song->duration)}}
    {{'views =' . $song->views}}

    @php $filePath = public_path('storage/' . $song->path) @endphp

    {{--    {{$filePath = '/Users/hadees/song-player/storage/app/public/' . $song->path}}--}}
    @if(file_exists($filePath))
    <audio controls id="audioPlayer" data-song-id="{{$song->id}}" >
        <source src="{{asset('/storage/' . $song->path )}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    @endif

    @if(auth()->user()->favorites->contains($song->id))
        <a href="{{ route('remove.favorites', ['song' => $song->id]) }}">Remove from Favorite</a>
    @else
        <a href="{{ route('add.favorites', ['song' => $song->id]) }}">Add to Favorite</a>
    @endif

    {{'by ' . $song->artist->name}}
</div>
@endforeach

<p>
    {{$songs->links()}}
</p>

