@extends('admin.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        
    </div>

    <section class="content">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Detail
                        <a href="{{route('admin.orderHistory.history')}}" class="float-right btn btn-success btn-sm">View All</a>
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($order->product as $key=>$item)
                        <div>
                            <span>{{ $item['name'] }}</span>
                            <span>: MMK {{ $item['price'] }}</span>
                            <span>** {{ $quantity[$key] }}</span>
                        </div>
                    @endforeach                    
                    <h4>Total : MMK {{$order->total_price}}</h4>
                    <div>----------------------------------------------------</div>
                    <div>Name: {{$order->customer->name}}</div>
                    <div>Phone Number: {{$order->customer->phone}}</div>
                    <div>Address: {{$order->customer->address}}</div>
                    <div>Order Code: {{$order->order_code}}</div>
                    <div>----------------------------------------------------</div>                    
                    <div>----------------------------------------------------</div>
                </div>
            </div>

    </section>
</div>
  

@endsection