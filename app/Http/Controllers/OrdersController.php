<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {

        $id =  \auth()->user()->orders()->first()->id;

        /*
         * have to learn this query
         */
        $products = OrderProduct::where('order_id', $id)
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('SUM(order_products.qty) as qty'))
            ->groupBy('products.id')
            ->get();


        return view('basket', ['products' => $products]);
    }
    public function store(Product $product)
    {
        $order = Auth::user()
            ->orders()
            ->firstOrCreate([
                'status'=> 'pending',
        ]);

        if (
            $item = $order->items()
            ->where('order_id', \auth()->user()->orders()->first()->id)
            ->where('product_id', $product->id)->first()
        )
        {
            $item->update([
                'qty' => $item->qty + \request('qty'),
                'price' => $product->price * ($item->qty + \request('qty'))
                ]);
            return redirect()->back();
        }

        $order->items()->create([
            'qty' => \request('qty'),
            'product_id' => $product->id,
            'price' => $product->price * \request('qty'),
        ]);
        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        OrderProduct::where('product_id', $product->id)
            ->where('order_id', \auth()->user()->orders()->first()->id)->delete();
        return redirect()->back();
    }
}
