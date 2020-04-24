@extends ('layouts.app')

@section('title')
Senimart - {{ $artwork->title }}
@endsection

@section ('content')
<div class="breadcrumbs">
    <p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('artworks.index') }}">Artworks</a> /
        {{ $artwork->title }}</p>
</div>

<section class="artworks-detail">
    <div class="art">
        <div class="art-item">
            <img class="activeimg" src="{{ asset('storage/'.$artwork->image) }}" alt="{{$artwork->slug}}"
                id="currentImage" />
        </div>
        @if ($artwork->gallery)
        <div class="arts">
            <div class="arts-item">
                <img src="{{ asset('storage/'.$artwork->image) }}" alt="{{$artwork->slug}}" />
            </div>
            @foreach (json_decode($artwork->gallery, true) as $images)
            <div class="arts-item">
                <img src="{{ URL::to('storage/' . $images)}}" alt="{{$artwork->slug}}">
            </div>
            @endforeach
        </div>
        @endif
    </div>


    <div class="desc">
        <h1>{{ $artwork->title}}</h1>
        <a href="/artist/{{$artwork->artists->slug}}">
            <h4>{{ $artwork->artists->name}}</h5>
        </a>
        <h3>Rp.{{ $artwork->price}}</h3>
        <hr />
        <a href="{{ route('artworks.index', ['category' => $artwork->category->slug ])}}">
            <p>{{$artwork->category->name}}</p>
        </a>
        <p>{{$artwork->subcategory}}</p>
        <p>{{$artwork->weight}}g</p>
        <p>{{ $artwork->sizeHeight}}cm (H) / {{ $artwork->sizeWidth}}cm (W)</p>
        <hr />
        <p>Description</p>
        <p>
            {!! $artwork->detail !!}
        </p>
        <div class="artwork-button">
            <form action="{{route('cart.store')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$artwork->id}}">
                <input type="hidden" name="title" value="{{$artwork->title}}">
                <input type="hidden" name="price" value="{{$artwork->price}}">
                <input type="hidden" name="weight" value="{{$artwork->weight}}">
                <button type="submit" class="button-black">Add to Cart</button>
                <a href="/cart/wishlist/{{$artwork->id}}" class="button-list-black">Wishlist &nbsp; <i
                        class="fa fa-heart"></i></a>
            </form>

        </div>

    </div>
</section>

<div class="title">
    <h1>Similiar Arts</h1>
</div>

<div class="similiar">
    @foreach ($similiars as $similiar)
    <div class="art-image">
        <a href="/artwork/{{$similiar->slug}}">
            <img src="{{asset('storage/'. $similiar->image)}}" alt="" />
        </a>
        <a href="/artwork/{{$similiar->slug}}">
            <h2>{{$similiar->title}}</h2>
        </a>
        <a href="/artist/{{$similiar->artists->slug}}">
            <h3>{{$similiar->artists->name}}</h3>
        </a>
        <h5 id="price">Rp.{{$similiar->price}}</h5>
        <a href="{{ route('artworks.index', ['category' => $similiar->category->slug ])}}">
            <p>{{$similiar->category->name}}</p>
        </a>
        {{-- <p>{{$similiar->sizeHeight}} cm (H) / {{$similiar->sizeWidth}} cm (W)</p> --}}

    </div>
    @endforeach
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
    integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>

@endsection

@section('js')
<script>
    (function() {
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.arts-item');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
          // currentImage.src = this.querySelector('img').src;

            currentImage.classList.remove('activeimg');

            currentImage.addEventListener('transitionend', () => {
                currentImage.src = this.querySelector('img').src;
                currentImage.classList.add('activeimg')
            })

            images.foreach((element) => element.classList.remove('selectedimg'));
            this.classList.add('selectedimg');
        }
    })();
</script>
@endsection