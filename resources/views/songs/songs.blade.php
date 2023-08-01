<a href=""><-Dashboard</a>
<h2> <img src="" alt="" class="rounded-sm" width="20" height="30">{{$artist->name}}</h2>
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
