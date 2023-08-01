<a href=""><-Dashboard</a>
<h1>
@if($artist->image != null)
<img src="{{asset('storage/' . $artist->image)}}" alt="not found" class="rounded-sm" width="20" height="30">
    @else
    <img src="{{asset('storage/artist-images/bjnlGICVebXCMTqYvEUf6uCxZyQs2YFNHV1GoVW5.png')}}"
         alt="not found" class="rounded-sm" width="20" height="30">
@endif
    {{$artist->name}}
</h1>

<h1>{{$artist->info}}</h1>

<h3>{{'Songs'}}</h3>

<form method="POST" action="">

    <input type="text" name="search" placeholder="Find something"
           class="bg-transparent placeholder-black font-semibold text-sm"
           value="{{request('search')}}"
    >
    <input type="submit" value="search">
</form>
    @each('partials.song', $songs, 'song')
