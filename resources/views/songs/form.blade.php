
@extends('layouts.app')

@section('content')
<h1>Add New Song</h1>
<form method="POST" action="{{route('songs.store')}}" enctype="multipart/form-data">
    @csrf
    <label>Song Name</label><br>
    <input type="text" name="name" value="{{old('name')}}"><br><br>
    @error('name')
    <p style="color: red">{{$message}}</p>
    @enderror

    <label>UploadAudio</label><br>

    <input name="audio" type="file" value="{{old('audio')}}"><br><br>

    @error('audio')
    <p style="color: red">{{$message}}</p>
    @enderror

    <label>Artist</label><br>
    <select name="artist_id">
        @foreach($artists as $artist)
            <option value="{{$artist->id}}">{{$artist->name}}</option>
        @endforeach
    </select><br><br>

    <input type="submit" value="Publish">
</form>
@endsection
