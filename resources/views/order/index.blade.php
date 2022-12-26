@extends('order.layout')
   
@section('content')


<div class="container">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container-fluid p-0"> <a class="navbar-brand text-uppercase fw-800" href="#">Blah Restaurant</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="fas fa-bars"></span> </button>
            <div class="collapse navbar-collapse" id="myNav">
                <div class="navbar-nav ms-auto"> 
                    <a class="nav-link active" aria-current="page" href="#">All</a>
                    @foreach($categories as $category)
                    <a class="nav-link" href="#">{{$category->name}}</a>
                    @endforeach
            </div>
        </div>
    </nav>
    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3">
            <div class="thumbnail">
            <div class="product"> <img src="{{asset($product->gallery)}}" alt=""></div>
            <div class="title pt-4 pb-1">{{$product->name}}</div>
            {{-- <h5 class="pt-4 pb-1">{{ $product->name }}</h4> --}}
            <div class="title pt-1 pb-1">{{$product->description}}</div>
            <div class="price">MMK {{$product->price}}</div>
            <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>   
        </div>
        </div>
        @endforeach
    </div>

    
</div>

@endsection