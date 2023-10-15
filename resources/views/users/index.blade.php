<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Destroy</th>
        <th>Update</th>
        <th>Block</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>
{{--                @if(isset($artist->image))--}}
{{--                    <img src="{{asset('storage/' . $artist->image)}}" alt="" class="rounded-sm" width="20" height="30">--}}
{{--                @else--}}
{{--                    <img src="{{asset('storage/artist-images/bjnlGICVebXCMTqYvEUf6uCxZyQs2YFNHV1GoVW5.png')}}"--}}
{{--                         alt="not found" class="rounded-sm" width="20" height="30">--}}
{{--                @endif--}}
                <a href="">{{$user->name}}</a>
            </td>
            <td>{{$user->email}}</td>
            <td><a href="{{route('users.delete',['user' => $user->id])}}">Delete</a></td>
            <td><a href="{{route('users.edit', ['user' => $user->id])}}">Edit</a></td>
            @if(!$user->is_banned)
                <td><a href="{{route('users.ban', ['user' => $user->id])}}">Ban</a></td>
            @else
                <td><a href="{{route('users.unban', ['user' => $user->id])}}">Unban</a></td>
            @endif

        </tr>
    @endforeach
</table>
