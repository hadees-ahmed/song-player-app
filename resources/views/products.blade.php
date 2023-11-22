<table>
    <tr>
        <th>{{__('Product')}}</th>
        <th>{{__('Price')}}</th>
        <th>{{__('qty')}}</th>
        <th>{{'basket'}}</th>

    </tr>

@foreach ($products as $product)
        <form method="POST" action="{{!$product->orders()->where('status', 'in basket')->exists() ? route('orders.store', ['product' => $product->id]) :route('remove.basket', ['product' => $product->id]) }}" enctype="multipart/form-data">
            @csrf
        <tr>
            <td>
                <p>{{$product->name}}</p>
            </td>
            <td>
                <p>{{$product->price}}</p>
            </td>
            <td>
                <select name="qty">
                    @for($i = 0; $i < 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
{{--            @if(!$product->orders()->where('status', '')->exists())--}}
            <td>
                <input type="submit" value="Add To Basket"></input>
            </td>
{{--            @else--}}
{{--                <td>--}}
{{--                <input type="submit" value="Remove From Basket"></input>--}}
{{--                </td>--}}
{{--            @endif--}}
        </tr>
    </form>
@endforeach

</table>

<form action="{{route('orders.basket')}}">
    <input type="submit" value="Go To Basket"></input>
</form>
