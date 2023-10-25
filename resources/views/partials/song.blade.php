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
            <button type="submit">{{__('Remove From Favorites')}}</button>
        </form>
    @else
        <form method="POST" action="{{route('add.favorites', ['song' => $song->id])}}">
            @csrf
            <button type="submit">{{__('Add To Favorites')}}</button>
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
                        <option value={{ $i }} > {{ $i }} {{__('Star')}}</option>
                    @endforeach
                </select>
                <button type="submit"> {{__('Rate')}}</button>
            </form>
        </div>
    @else
        <p> {{__('You Rated')}} {{$rating->stars}} {{__('Stars')}}</p>
    @endif

    <div>
        <p>{{__('Average Ratings')}}  {{round($song->ratings_avg_stars, 1)}} </p>
    </div>

    <div>
    <a href="{{ route('songs.edit', ['song' => $song->id]) }}">Edit</a> <!-- Add Edit Link -->
    <span style="margin-left: 10px;"></span> <!-- Add some spacing between buttons -->
    <a href="{{ route('songs.delete', ['song' => $song->id]) }}">Delete</a> <!-- Add Delete Link -->
</div>
</div>
@endforeach

    {{$songs->links()}}

