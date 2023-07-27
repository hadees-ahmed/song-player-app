<h3>{{'Favorites'}}</h3>
@@foreach($songs as $song)
@include('partials.song', $song)
@endforeach
