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

{{--    @if(! auth()->user()->ratings->pluck('song_id')->contains($song->id))--}}
    @if(! $rating = auth()->user()->ratings->where('song_id', $song->id)->first())
        <div>
            <form method="POST" action="{{route('ratings.store', ['song' => $song->id])}}">
                @csrf
                <select name="stars">
                    @foreach(range(1, 5) as $i)
                        <option value={{ $i }} > {{ $i }} Star</option>
                    @endforeach
                </select>
                <button type="submit"> Rate</button>
            </form>
        </div>
    @else
        <p> You rated {{$rating->stars}} Stars</p>
    @endif

    <div>
        <p>Average Ratings  {{round($song->ratings_avg_stars, 1)}} </p>
    </div>

    <div>
    <a href="{{ route('songs.edit', ['song' => $song->id]) }}">Edit</a> <!-- Add Edit Link -->
    <span style="margin-left: 10px;"></span> <!-- Add some spacing between buttons -->
    <a href="{{ route('songs.delete', ['song' => $song->id]) }}">Delete</a> <!-- Add Delete Link -->
</div>
</div>
@endforeach

    {{$songs->links()}}

