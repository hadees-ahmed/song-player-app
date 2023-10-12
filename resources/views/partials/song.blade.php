@foreach($songs as $song)
<div class="p-6 text-gray-900"  style="display: flex; justify-content: space-between; align-items: center;">
    <div>
    {{ $song->name }}
    {{ 'Duration= ' . formatDuration($song->duration)}}
    {{'views =' . $song->views}}

    @php $filePath = public_path('storage/' . $song->path) @endphp

    {{--    {{$filePath = '/Users/hadees/song-player/storage/app/public/' . $song->path}}--}}
    @if(file_exists($filePath))
    <audio  onplay="doSomething({{ $song->id}})"  controls id="audioPlayer"  >
        <source src="{{asset('/storage/' . $song->path )}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @endif

    @if(auth()->user()->favorites->contains($song->id))

{{--        <a href="{{ route('remove.favorites', ['song' => $song->id]) }}">Remove from Favorite</a>--}}
        <form method="POST" action="{{route('add.favorites', ['song' => $song->id])}}">
            @csrf
            @method('DELETE')
            <button type="submit">Remove From Favorites</button>
        </form>
    @else
        <form method="POST" action="{{route('add.favorites', ['song' => $song->id])}}">
            @csrf
            <button type="submit">Add To Favorites</button>
        </form>    @endif
        {{'by ' . $song->artist->name}}

    </div>
<div>
    <a href="{{ route('songs.create', ['song' => $song->id]) }}">Edit</a> <!-- Add Edit Link -->
    <span style="margin-left: 10px;"></span> <!-- Add some spacing between buttons -->
    <a href="{{ route('songs.create', ['song' => $song->id]) }}">Delete</a> <!-- Add Delete Link -->
</div>
</div>
@endforeach

    {{$songs->links()}}

