@extends('layouts.app')

@section ('title')
Senimart - Checkout
@endsection

@section('content')
<div class="cart">

    <h1>Checkout</h1>
    <h4>Order ID: {{$sales->id}}</h4>
    <hr>
    @foreach ($checkoutItem as $item)
    <div class="cart-product">
        <div class="cart-img">
            <a href="{{route('artworks.show', $item->artworks->slug)}}"><img
                    src="{{ asset('storage/'.$item->artworks->image) }}" alt=""></a>
        </div>
        <div class="cart-detail">
            <a href="{{route('artworks.show', $item->artworks->slug)}}">
                <h1>{{$item->artworks->title}}</h1>
            </a>
            <h3>{{$item->artworks->artists->name}}</h3>
            <p>{{$item->artworks->category->name}}</p>
            <p> {{$item->artworks->sizeHeight}} (H) / {{$item->artworks->sizeWidth}} (W)</p>
        </div>
        <div class="cart-price">
            <h1>Rp.{{$item->artworks->price}}</h1>
            <h3>Quantity : {{$item->qty}}</h3>
        </div>
    </div>
    @endforeach

    <hr>
    <div class="total">
        <h1>Total Price : Rp.{{$item->sales->totalPrice}}</h1>
    </div>
    <hr>
    <h2>Shipping Address</h2>
    <form method="post" action="{{route('sales.address', $sales->id)}}">
    @csrf
    @method('PUT')
    <textarea name="address" rows="4" cols="40">{{$sales->address}}</textarea>
    <hr>
    <div class="total">
        <div class="cart-button">
            <a href="/checkout/remove/{{$sales->id}}" class="button">Cancel</a>
            <!-- <a href="" class="button">Confirm</a> -->
            <input type="submit" value="Confirm">
            </form> 
        </div>
    </div>
</div>
@endsection