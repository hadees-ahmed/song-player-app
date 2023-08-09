@extends('layouts.app')

@section('content')
<h1>Artists</h1>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<form method="POST" action="">

    <input type="text" name="search" placeholder="Search Artist"
           value="{{request('search')}}"
    >
    <input type="submit" value="search">
</form>

<form method="POST" action="{{route('artists.store')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="artist_image">

    @error('artist_image')
    <p style="color: red">{{$message}}</p>
    @enderror
    <select name="artist_id">
        @foreach($artists as $artist)
        <option value="{{$artist->id}}">{{$artist->name}}</option>
        @endforeach
    </select>
    <input type="submit" value="save">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Language</th>
    </tr>
    @foreach($artists as $artist)
    <tr>

        <td>

            @if(isset($artist->image))
            <img src="{{asset('storage/' . $artist->image)}}" alt="" class="rounded-sm" width="20" height="30">
            @else
                <img src="{{asset('storage/artist-images/bjnlGICVebXCMTqYvEUf6uCxZyQs2YFNHV1GoVW5.png')}}"
                     alt="not found" class="rounded-sm" width="20" height="30">
            @endif
            <a href="{{route('songs.index', ['artist_id' => $artist->id])}}">{{$artist->name}} {{'( ' . $artist->songs_count . ' Songs )'}}</a>
        </td>
        <td>{{$artist->language->name}}</td>
    </tr>
    @endforeach
</table>
@endsection







