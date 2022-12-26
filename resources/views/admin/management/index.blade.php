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
                <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
            </div>

            <section class="content">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Code</th>
                            <th>Customer</th>
                            <th>Customer Phone</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>                    
                            <th>#</th>
                            <th>Order Code</th>
                            <th>Customer</th>
                            <th>Customer Phone</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>                                    
                                    <td>{{$order->order_code}}</td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->customer->phone}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        <input data-id="{{$order->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Done" data-off="NotYet" {{ $order->done ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.orderManagement.show', ['id' => $order->id])}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this data?')" href="{{route('admin.orderManagement.delete', ['id' => $order->id])}}" 
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </section>
        </div>
</div>

<script>
    $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var order_id = $(this).data('id');
          var overview = 1;
           
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/admin/orderManagement/changeStatus',
              data: {'status': status, 'id': order_id, 'overview': overview},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endsection