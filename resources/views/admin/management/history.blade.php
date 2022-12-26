@extends('admin.layout')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success text-center">
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<div class="content-wrapper">
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders History</h6>
        </div>

        <section class="content">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Customer</th>
                        <th>Customer's Phone</th>
                        <th>Ordered Time</th>
                        <th>Action</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @php $total = 0 @endphp
                    @if($orders)
                        @foreach ($orders as $order)
                            @php $total += $order->total_price  @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>                                    
                                <td>{{$order->order_code}}</td>
                                <td>{{$order->customer->name}}</td>
                                <td>{{$order->customer->phone}}</td>
                                <td>{{$order->created_at}}</td>                                
                                <td>
                                    <a href="{{route('admin.orderHistory.show', ['id' => $order->id])}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a onclick="return confirm('Are you sure to delete this data?')" href="{{route('admin.orderHistory.delete', ['id' => $order->id])}}" 
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                                <td>{{$order->total_price}}</td>                             
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>                        
                            <td></td>
                            <td></td>                            
                            <td></td>                            
                            <td>Total</td>
                            <td>{{$total}}</td>
                        </tr>
                    @endif 
                </tbody>                
            </table>
        </section>
    </div>
</div>

@endsection

