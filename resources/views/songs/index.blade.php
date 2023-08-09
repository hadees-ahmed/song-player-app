@extends('layouts.app')

@section('content')
<a href="{{route('dashboard')}}"><-Dashboard</a>
<h1>
    @if(isset($artist))
@if($artist->image)
<img src="{{asset('storage/' . $artist->image)}}" alt="not found" class="rounded-sm" width="20" height="30">
    @else
    <img src="{{asset('storage/artist-images/bjnlGICVebXCMTqYvEUf6uCxZyQs2YFNHV1GoVW5.png')}}"
         alt="not found" class="rounded-sm" width="20" height="30">
@endif
    {{$artist->name}}
</h1>

<h1>{{$artist->info}}</h1>
@endif

<h3>{{'Songs'}}</h3>

<form method="POST" action="">

    <input type="text" name="search" placeholder="Find something"
           class="bg-transparent placeholder-black font-semibold text-sm"
           value="{{request('search')}}"
    >
    <input type="submit" value="search">
</form>
    @include('partials.song',  ['songs' => $songs])
<script>
    function doSomething(songId) {
        fetch('songs/' + songId + '/views-increment', {
            method: 'POST',
            headers: {

                'Content-Type': 'application/json',
            },
        });
    }
</script>

<script src="{{ asset('js/audio-player.js') }}" defer></script>
@endsection
