
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

<table>
    <tr>
        <th>Name</th>
        <th>Language</th>
    </tr>
    @foreach($artists as $artist)
    <tr>

        <td>
            <img src="" alt="" class="rounded-sm" width="20" height="30">
            <a href="{{route('songs.index', ['artist' => $artist->id])}}">{{$artist->name}}(Song Count)</a>
        </td>
        <td>{{$artist->language->name}}</td>
    </tr>
    @endforeach
</table>







