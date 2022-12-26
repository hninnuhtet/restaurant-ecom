@extends('order.layout')
  
@section('content')
<div class="container-fluid">
    <form action="{{route('orderstore')}}" method="post">
    {{-- <form action="#" method="post"> --}}

    @csrf
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    Order
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div> <br>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div> <br>
                    @endif

                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <div>
                            <span>{{ $details['name'] }}</span>
                            <span>: MMK {{ $details['price'] }}</span>
                            <span>** {{ $details['quantity'] }}</span>
                        </div>
                    @endforeach                    
                    <h4>Total : MMK {{$total}}</h4>
                    <div>----------------------------------------------------</div>
                   

                    <div class="form-group">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Phone Number<span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Address<span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control">
                    </div>                    

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('cart')}}" class="btn btn-danger m-3">Cancel</a>
            </div>
    </div>                
    </form>  
</div>
@endsection