@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="profile">
    <div class="alert">
        @if (session()->has('success_message'))

        <div class="alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="flex-profile">
        <h1 class="title-profile">My Orders</h1>
        <div class="sidebar" id="sidebar">
            <div class="category">
                <a href="{{ route('profile.edit') }}">
                    <h1>My Profile</h1>
                </a>
                <hr>
            </div>

            <div class="category">
                <a href="{{ route('address.index') }}">
                    <h1>Address</h1>
                </a>
                <hr>
            </div>

            <div class="orders">
                <a href="{{ route('orders.index') }}">
                    <h1>Orders</h1>
                </a>
                <hr>
            </div>

            <div class="wishlist">
                <a href="{{route('wishlist.index')}}">
                    <h1>Wishlist</h1>
                </a>
                <hr>
            </div>
        </div>
        @if ($orders->count() == 0 )
        <div class="profile-content">
            <h3>There's no orders</h3>
            <p>Shop now</p>
            <a href="{{ route('artworks.index') }}" class="button-black">Go Shop</a>
        </div>
        

        @else
        <div class="profile-content">
            @foreach ($orders as $order)
            <h3>Order ID: <a href="/payment/{{ $order->id }}">{{ $order->id }}</a></h3>
            <p>Total Payment: Rp{{ $order->totalPrice+$order->shipcost }}</p>

            @foreach ($order->artworks as $artwork)
            <div class="order-item">
                <img src="{{ asset('storage/'. $artwork->image) }}" alt="">
                <div class="order-text">
                    <h4>{{ $artwork->title }}</h4>
                    <h5>{{ $artwork->artists->name }}</h5>
                </div>

            </div>

            @endforeach
            <hr>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection



</html>