<h3>{{'Favorites'}}</h3>

{{--@to load locale route--}}
<x-locale/>

@include('partials.song', ['songs' => $songs] )
