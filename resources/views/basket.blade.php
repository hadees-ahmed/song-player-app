<table>
    <tr>
        <th>{{__('Name')}}</th>
        <th>{{__('Price')}}</th>
        <th>{{__('qty')}}</th>
        <th>{{'basket'}}</th>
    </tr>

    @foreach ($products as $product)
        <form method="POST" action="{{ route('orders.destroy', ['product' => $product->id])  }}" enctype="multipart/form-data">
            @csrf
            <tr>
                <td>
                    <p>{{$product->name}}</p>
                </td>
                <td>
                    <p>{{$product->price * $product->qty}}</p>
                </td>
                <td>
                    <p>{{$product->qty}}</p>
                </td>
                {{--            @if(!$product->orders()->where('status', '')->exists())  --}}
                <td>
                    <input type="submit" value="Remove From Basket"></input>
                </td>
            </tr>
        </form>
    @endforeach
    <p>Total {{$products->sum('price')}}</p>
</table>
