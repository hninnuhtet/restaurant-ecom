<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Blah Restaurant</title>
</head>
<body>
    <div class="col-lg-3 col-sm-6 m-3">
        <div class="card">
            <div class="card-header">
                Receipt
            </div>
            <div class="card-body">
                @php $total = 0 @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity'] @endphp
                    <div>
                        <span>{{ $item['name'] }}</span>
                        <span>: MMK {{ $item['price'] }}</span>
                        <span>** {{ $item['quantity'] }}</span>
                    </div>
                @endforeach                    
                <h4>Total : MMK {{$total}}</h4>
                <div>----------------------------------------------------</div>
                <div>Name: {{$order->customer->name}}</div>
                <div>Phone Number: {{$order->customer->phone}}</div>
                <div>Address: {{$order->customer->address}}</div>
                <div>Order Code: {{$order->order_code}}</div>
                <div>----------------------------------------------------</div>
                <div>Thank You *** Order has been successully added.</div> 
                <div>----------------------------------------------------</div>
                <div>----------------------------------------------------</div>
                <a href="{{route('index')}}" class="btn btn-success">Done</a>

        </div>
    </div> 
</body>
</html>
 